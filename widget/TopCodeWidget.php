<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/21/19
 * Time: 00:11
 */

add_action('widgets_init', 'create_thachpham_widget');
function create_thachpham_widget() {
    register_widget('Thachpham_Widget');
}

class Thachpham_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'submit_top_code_widget', // id của widget<br />
            'Bảng xếp hạng', // tên của widget</p>
            array(
                'description' => 'Bảng xếp hạng submit' // mô tả<br />
            )
        );
    }

    function getSqlTop($isFull = false, $total = 1, $userNumber = 15) {
        $sql = "SELECT user_id, author, total 
                FROM
                    (SELECT user_id, author, COUNT(user_id) as total
                     FROM (
                         SELECT submit_id, user_id, author, post_id
                         FROM `wp_submit` 
                         WHERE total = correct
                         GROUP BY user_id, post_id
                     ) as tb1
                     GROUP BY user_id
                ) as tb2";
        if ($isFull) $sql .= " WHERE total = $total";
        else $sql .= " WHERE total < $total";
        $sql .= " ORDER BY total DESC
                LIMIT 0, $userNumber";
        return $sql;
    }

    function form($instance) {
        parent::form($instance);
        $default = array('title' => 'Bảng xếp hạng', 'user_number' => 10, 'total' => 67);
        $instance = wp_parse_args((array)$instance, $default);
        $title = esc_attr($instance['title']);
        $userNumber = esc_attr($instance['user_number']);
        $total = esc_attr($instance['total']);
        echo "Tổng số bài <input class='widefat' type='number' name='" . $this->get_field_name('total') . "' value='" . $total . "' />";
        echo "Nhập tiêu đề <input class='widefat' type='text' name='" . $this->get_field_name('title') . "' value='" . $title . "' />";
        echo "Số người <input class='widefat' type='number' name='" . $this->get_field_name('user_number') . "' value='" . $userNumber . "' />";
    }

    function update($new_instance, $old_instance) {
        parent::update($new_instance, $old_instance);
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['user_number'] = strip_tags($new_instance['user_number']);
        $instance['total'] = strip_tags($new_instance['total']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $userNumber = $instance['user_number'];
        $total = $instance['total'];
        echo $before_widget;
        echo $before_title . $title . $after_title;

        global $wpdb;
        $sql = $this->getSqlTop(false, $total, $userNumber);
        $myrows = $wpdb->get_results($sql);

        echo '<ol>';
        foreach ($myrows as $row) {
            echo "<li><a href='" . home_url('/profile/') . "?id=$row->user_id" . "'>" . $row->author . "($row->total)</a></li>";
        }
        echo '</ol>';
        echo "<h3>Pro Coder (Full)</h3>";
        $sql = $this->getSqlTop(true, $total, $userNumber);
        $myrows = $wpdb->get_results($sql);
        echo '<ol>';
        foreach ($myrows as $row) {
            echo "<li><a href='" . home_url('/profile/') . "?id=$row->user_id" . "'>" . $row->author . "($row->total)</a></li>";
        }
        echo '</ol>';
        echo $after_widget;
    }
}