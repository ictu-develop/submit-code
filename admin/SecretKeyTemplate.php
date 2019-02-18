<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/02/2019
 * Time: 08:04
 */

class SecretKeyTemplate
{

    function __construct()
    {
        require_once 'style/lib.php';
        lib();
    }

    function title()
    {
        echo '<div class="container">';
        echo '<div class="row-12 bg-secondary justify-content-center">';
        echo '<div class="col text-center">';
        echo '<div class="p-3 mb-5 mt-2 bg-secondary text-white"><h3 class="mb-0">Setup secret key</h3></div>';
        echo '</div>';
        echo '</div>';
    }

    function form()
    {
        require_once 'core/GetSecretKey.php';
        $getSecretKey = new GetSecretKey();
        $secretKey = $getSecretKey->get();

        echo '<div class="row">';
        echo '<div class="col-4">';
        echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Setup secret key</span>';
        echo '</nav>';
        // Start content
        echo '<form method="post" action="' . get_site_url() . '/wp-content/plugins/submit-code/admin/request/requestSetupSecretKey.php">
              <div class="form-group">';

        if ($secretKey != null)
            echo '<textarea name="key" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter secret key" required>' . $secretKey . '</textarea>';
        else
            echo '<textarea name="key" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter secret key" required></textarea>';

        echo '<small id="emailHelp" class="form-text text-muted">Never share your secret key with anyone else.</small>
              </div>
              
              <button type="submit" class="btn btn-primary">Save</button>
            </form>';
        // End content
        echo '</div>';
        echo '</div>';
    }

}