<?php

use App\Http\Controllers\LoginController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
//For index
    Route::get('/index', 'LoginController@index')->name('user.index');

//For registration
    Route::get('/signup', 'LoginController@signup')->name('user.signup');
    Route::post('/signup/store', 'LoginController@store')->name('user.store');
    Route::get('/signup/verify/{token}', 'LoginController@verifyEmail')->name('user.verify');
//For login
    Route::get('/signin', 'LoginController@login')->name('user.signin');
    Route::post('/signin/validate', 'LoginController@validateLogin')->name('user.validateLogin');
//For logout
    Route::match(['get','post'],'/logout', 'LoginController@destroy')->name('user.logout');


//For Category
    Route::get('main-category', 'CategoryController@index')->name('user.category.category');
    Route::match(['get','post'],'insert-category', 'CategoryController@addCategory')->name('user.category.categoryinsert');
    Route::match(['get','post','put'],'/edit-category{id}','CategoryController@editCategory')->name('user.category.categoryupdate');
    Route::match(['get','post','delete'],'/delete-category{id}','CategoryController@delCategory');

//For Sub-Category
    Route::get('main-sub-category', 'SubCategoryController@index')->name('user.subcategory.subcategory');
    Route::match(['get','post'],'insert-sub-category', 'SubCategoryController@addSubcategory')->name('user.subcategory.subcategoryinsert');
    Route::match(['get','post','put'],'/edit-sub-category{id}','SubCategoryController@editSubCategory')->name('user.subcategory.subcategoryupdate');
    Route::match(['get','post','put'],'/update-sub-category{id}','SubCategoryController@updateSubCategory')->name('user.subcategory.subcategoryupdate');
    Route::match(['get','post','delete'],'/delete-sub-category{id}','SubCategoryController@delSubcategory');

//For Role
    Route::get('main-role', 'role\UserRoleController@index')->name('user.role.role');
    Route::match(['get','post'],'insert-role', 'role\UserRoleController@addRole')->name('user.role.roleinsert');
    Route::match(['get','post','put'],'/edit-role{id}','role\UserRoleController@editRole')->name('user.role.roleupdate');
    Route::match(['get','post','delete'],'/delete-role{id}','role\UserRoleController@delRole');

//For country
    Route::get('main-country', 'address\CountryController@index')->name('user.address.country.country');
    Route::match(['get', 'post'], 'insert-country', 'address\CountryController@addCountry')->name('user.address.country.countryinsert');
    Route::match(['get','post','delete'],'/delete-country{id}','address\CountryController@delCountry');
    Route::match(['get', 'post','put'], 'edit-country{id}','address\CountryController@editCountry')->name('user.address.country.countryupdate');

//For state
    Route::get('main-state', 'address\StateController@index')->name('user.address.state.state');
    Route::match(['get', 'post'], 'insert-state', 'address\StateController@addState')->name('user.address.state.stateinsert');
    Route::match(['get','post','delete'],'/delete-state{id}','address\StateController@delState');
    Route::match(['get', 'post', 'put'], 'edit-state{id}','address\StateController@editState')->name('user.address.state.stateupdate');
    Route::match(['get', 'post', 'put'], 'update-state{id}','address\StateController@updateState')->name('user.address.state.stateupdate');

//For city
    Route::get('main-city', 'address\CityController@index')->name('user.address.city.city');
    Route::match(['get', 'post'], 'insert-city', 'address\CityController@addCity')->name('user.address.city.cityinsert');
    Route::match(['get','post','delete'],'/delete-city{id}','address\CityController@delCity');
    Route::match(['get','post','put'],'/edit-city{id}','address\CityController@editCity')->name('user.address.city.cityupdate');
    Route::match(['get','post','put'],'/update-city{id}','address\CityController@updateCity')->name('user.address.city.cityupdate');

//For product
    Route::get('main-product','Product\ProductController@index')->name('user.product.product');
    Route::match(['get', 'post', 'delete'], 'delete-product{id}','Product\ProductController@delProduct');
    Route::match(['get', 'post'], 'insert-product', 'Product\ProductController@addProduct')->name('user.product.productinsert');
    Route::match(['get', 'post', 'put'], 'edit-product{id}', 'Product\ProductController@editProduct')->name('user.product.productupdate');
    Route::match(['get', 'post', 'put'], 'update-product{id}', 'Product\ProductController@updateProduct')->name('user.product.productupdate');
    
//For Image
    Route::get( 'main-image', 'Product\ImageController@index')->name('user.product.image.image');
    Route::match(['get', 'post', 'put'], 'insert-image', 'Product\ImageController@addImage')->name('user.product.image.imageinsert');
    Route::match(['get', 'post', 'delete'], 'delete-image{id}', 'Product\ImageController@delImage');
    Route::match(['get', 'post', 'put'], 'edit-image{id}', 'Product\ImageController@editImage')->name('user.product.image.imageupdate');
    Route::match(['get', 'post', 'put'], 'update-image{id}', 'Product\ImageController@updateImage')->name('user.product.image.imageupdate');

//For quantity
    Route::get('main-quantity', 'Product\QuantityController@index')->name('user.product.quantity');
    Route::match(['get', 'post', 'delete'], 'delete-quantity', 'Product\QuantityController@delQuantity');
    Route::match(['get', 'post'], 'insert-quantity', 'Product\QuantityController@addQuantity')->name('user.product.quantityinsert');
    Route::match(['get', 'post', 'put'], 'edit-quantity{id}', 'Product\QuantityController@editQuantity')->name('user.product.quantityupdate');


//For dependent
Route::get('cat', 'Product\ProductController@index1')->name('user.product.productinsert');
Route::get('CatEdit{id}', 'Product\ProductController@CatEdit')->name('user.product.productinsert');
Route::get('CatEdit{id}', 'Product\ProductController@CatEdit')->name('user.product.productupdate');