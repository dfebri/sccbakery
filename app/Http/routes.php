<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Back
 */

use Carbon\Carbon;
use App\CategoryModel;
use App\ProductModel;

// use URL;
// use App;

$router->group([
    'namespace' => 'Admin\Controllers',
    'prefix'    => '_admin'
], function ($router) {
    Route::any('/', function () {
        return Redirect::to('_admin/login');
    });
    Route::get('/logout', array('as' => 'admin_logout', 'uses' => 'Login@do_logout'));
    Route::any('/login/dologin', array('as' => 'admin_login_process', 'uses' => 'Login@do_login'));
    Route::get('/login', array('as' => 'admin_login', 'uses' => 'Login@index'));

    $router->group([
        'middleware'    => 'admin_auth'
    ], function ($router) {
        /**
         * any new Routers here, because there is middleware for user auth
         * so another people cannt access directly
         */
        Route::any('/dashboard', array('as' => 'admin_dashboard', 'uses' => 'Dashboard@index'));

        Route::any('/slideshow', array('as' => 'admin_slideshow', 'uses' => 'Slideshow@index'));
        Route::any('/header_link', array('as' => 'admin_header_link', 'uses' => 'Content@header_link'));
        Route::any('/banner', array('as' => 'admin_banner', 'uses' => 'Content@banner'));
        Route::any('/home_video', array('as' => 'admin_home_video', 'uses' => 'Content@video'));
        Route::any('/footer', array('as' => 'admin_footer', 'uses' => 'Content@footer'));

        Route::any('/pages', array('as' => 'admin_pages', 'uses' => 'Pages@index'));

        Route::any('/static_pages', array('as' => 'admin_static_pages', 'uses' => 'StaticPages@index'));
        Route::any('/about', array('as' => 'admin_about', 'uses' => 'About@index'));
        Route::any('/upcoming_events', array('as' => 'admin_upcoming_events', 'uses' => 'UpcomingEvents@index'));
        Route::any('/meet_our_suppliers', array('as' => 'admin_meet_our_suppliers', 'uses' => 'MeetOurSuppliers@index'));
        Route::any('/why_choose_us', array('as' => 'admin_why_choose_us', 'uses' => 'WhyChooseUs@index'));
        Route::any('/industrial_line', array('as' => 'admin_industrial_line', 'uses' => 'IndustrialLine@index'));

        Route::any('/contact_message', array('as' => 'admin_contact_message', 'uses' => 'ContactMessage@index'));
        Route::any('/contact_address', array('as' => 'admin_contact_address', 'uses' => 'ContactAddress@index'));

        Route::any('/administrator', array('as' => 'admin_administrator', 'uses' => 'Administrator@index'));
        Route::any('/setting', array('as' => 'admin_setting', 'uses' => 'Setting@index'));
        Route::any('/google_analytics', array('as' => 'admin_ga', 'uses' => 'Setting@ga'));
        Route::any('/newsletter', array('as' => 'admin_newsletter', 'uses' => 'Newsletter@index'));
        Route::any('/social_link', array('as' => 'admin_social_link', 'uses' => 'SocialLink@index'));
        Route::any('/seo', array('as' => 'admin_seo', 'uses' => 'Content@seo'));

        Route::any('/product', array('as' => 'admin_product', 'uses' => 'Product@index'));
        Route::any('/product_image', array('as' => 'admin_product_image', 'uses' => 'ProductImage@index'));
        Route::any('/brands', array('as' => 'admin_brands', 'uses' => 'Brand@index'));
        Route::any('/categories', array('as' => 'admin_categories', 'uses' => 'Category@index'));
    });
});

/**
 * Front
 */
$router->group([
    'namespace' => 'Http\Controllers'
], function ($router) {
    Route::get('/sitemap', function () {
        $sitemap = App::make("sitemap");
        $sitemap->add(URL::to('/'), Carbon::now());
        $sitemap->add(URL::to('/about'), Carbon::now());
        $sitemap->add(URL::to('/product'), Carbon::now());
        $sitemap->add(URL::to('/category'), Carbon::now());
        $sitemap->add(URL::to('/category/blast-freezer'), Carbon::now());
        $sitemap->add(URL::to('/category/bread-line'), Carbon::now());
        $sitemap->add(URL::to('/category/chiller'), Carbon::now());
        $sitemap->add(URL::to('/category/cooking-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/divider-rounder'), Carbon::now());
        $sitemap->add(URL::to('/category/dough-moulder'), Carbon::now());
        $sitemap->add(URL::to('/category/dough-sheeter'), Carbon::now());
        $sitemap->add(URL::to('/category/filling-and-dosing'), Carbon::now());
        $sitemap->add(URL::to('/category/final-proofer'), Carbon::now());
        $sitemap->add(URL::to('/category/freezer'), Carbon::now());
        $sitemap->add(URL::to('/category/fryer'), Carbon::now());
        $sitemap->add(URL::to('/category/miscellaneous'), Carbon::now());
        $sitemap->add(URL::to('/category/modular-oven'), Carbon::now());
        $sitemap->add(URL::to('/category/pizza-oven'), Carbon::now());
        $sitemap->add(URL::to('/category/planetary-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/retarder-proofer'), Carbon::now());
        $sitemap->add(URL::to('/category/showcase'), Carbon::now());
        $sitemap->add(URL::to('/category/spiral-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/various-ovens'), Carbon::now());
        // $sitemap->add(URL::to('category/miscellaneous'), Carbon::now())
        // $product = ProductModel::all();    
        // foreach ($product as $product) {
        //     $sitemap->add(URL::to('/category/'. $product->permalink), $product->update_at);
        // }
        // dd($product);
        $sitemap->add(URL::to('/brand'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chung-hou'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/minipan-taiwan'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/vmi'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chan-mag'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chung-shen'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/daub'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/panem'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/eurofours'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chih-hsing'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/rondo'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/wachtel'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/revent'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/ferneto'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/edhard-usa-2'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/belshaw-usa'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/jendah-taiwan'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/yang-jenq-taiwan-1'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/merlin-perkins'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/pavoni-italia'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/yuan-jan-taiwan'), Carbon::now()); 
        // $sitemap->add(URL::to('/brand/hemao-taiwan'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/artesano-1'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/effe-uno'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/sunmix'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/bernadi'), Carbon::now());
        $sitemap->add(URL::to('/page/food-service'), Carbon::now());
        $sitemap->add(URL::to('/industrial-line'), Carbon::now());
        $sitemap->add(URL::to('/contact'), Carbon::now());

        return $sitemap->render('xml');
    });

    Route::get('/', function () {
        return Redirect::to('home');
    });
    Route::get('home', array('as' => 'home', 'uses' => 'HomePage@index'));
    Route::any('page/{permalink}', array('as' => 'pages', 'uses' => 'Page@load'));

    Route::get('product/{type}/{name}/{detail}', array('as' => 'product', 'uses' => 'Product@detail'));
    Route::get('category', array('as' => 'category_null', 'uses' => 'Product@category'));
    Route::get('category/{name}', array('as' => 'category', 'uses' => 'Product@category'));
    Route::get('brand', array('as' => 'brand_null', 'uses' => 'Product@brand'));
    Route::get('brand/{name}', array('as' => 'brand', 'uses' => 'Product@brand'));

    Route::post('send_message', array('as' => 'send_message', 'uses' => 'Process@sendMessage'));
    Route::any('search/', array('as' => 'search', 'uses' => 'Search@index'));
    Route::any('search/{permalink}', array('as' => 'search_params', 'uses' => 'Search@search'));
    Route::post('process/subscribe', array('as' => 'dosubscribe', 'uses' => 'Process@do_subscribe'));
    Route::get('not-found', array('as' => 'error-page', 'uses' => 'Page@error'));

    Route::any('{permalink}', array('as' => 'single-page', 'uses' => 'Page@create'));
});
