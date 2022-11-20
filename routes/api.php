<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\Bid;
use App\Models\User;
use App\Http\Controllers\LoginRegistering;
use App\Http\Controllers\BidController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\CategoriesAttributes;
use App\Http\Controllers\Upload;
use App\Http\Controllers\UploadAdmin;
use App\Http\Controllers\GetProducts;
use App\Http\Controllers\mailsSender;
use App\Http\Controllers\Rtest;
use App\Http\Controllers\Email_verif;
use App\Http\Controllers\Calculation;
use App\Http\Controllers\UserSpace;
// use App\Http\Controllers\Paypal_;
// use Aimeos\MShop\Service\Provider\Payment\PayPalExpress
use App\Http\Controllers\SellSpaceManagement;
use App\Http\Controllers\Add_User_Profil_Photo;
use App\Http\Controllers\Teams;
use App\Http\Controllers\Interaction;
// use App\Models\Team;
use App\Http\Controllers\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('throttle:120,1')->get(
    '/register/{email}/{password}/{lastname}/{firstname}/{ville}/{latitude}/{longitude}',
    [LoginRegistering::class, 'register']
);
Route::middleware('throttle:120,1')->get(
    '/login/{email}/{password}',
    [LoginRegistering::class, 'login']
);

Route::middleware('throttle:120,1')->post(
    '/connected/{token}',
    [LoginRegistering::class, 'check_session_token']
);

Route::middleware('throttle:120,1')->get(
    '/like/{token}/{article_id}',
    [FavorisController::class, 'add']
);

Route::middleware('throttle:120,1')->get(
    '/seeIfLIked/{token}/',
    [FavorisController::class, 'seeIfLIked']
);

Route::middleware('throttle:120,1')->get(
    '/seeIfLIked_GET/{token}',
    [FavorisController::class, 'seeIfLIked_GET']
);

Route::middleware('throttle:120,1')->get(
    '/mostLiked',
    [FavorisController::class, 'mostLiked']
);

Route::middleware('throttle:120,1')->get(
    '/getAllCategoriesAttributes',
    [CategoriesAttributes::class, 'getAll']
);

Route::middleware('throttle:120,1')->get(
    '/getATTR_CAT',
    [CategoriesAttributes::class, 'getATTR_CAT']
);
Route::middleware('throttle:120,1')->get(
    '/getATTR_WAYS/{catID}',
    [CategoriesAttributes::class, 'getATTR_WAYS']
);
Route::middleware('throttle:200,1')->post(
    'store',
    [Upload::class, 'store']
);
Route::middleware('throttle:120,1')->get(
    'setProductDate',
    [UploadAdmin::class, 'setProductDate']
);

Route::middleware('throttle:120,1')->get(
    'declineProduct',
    [UploadAdmin::class, 'declineProduct']
);
//
Route::middleware('throttle:120,1')->get(
    '/testing/{catID}',
    [FavorisController::class, 'test']
);

Route::middleware('throttle:120,1')->get(
    '/bid/{article_id}/{token}/{bidEntring}/{category}',
    [BidController::class, 'bid']
);
Route::get(
    '/getBid/{id}',
    [BidController::class, 'getBid']
);
Route::get(
    '/getBidWithAugmentaion/{category}/{id}',
    [BidController::class, 'getBidWithAugmentaion']
);



Route::get(
    '/getALLproduct/{category_id}',
    [GetProducts::class, 'getALlproductsForhomePage']
);

Route::get(
    '/search/{searchQuery}',
    [GetProducts::class, 'search']
);

Route::get(
    '/bigsearch/{searchQuery}',
    [GetProducts::class, '__BigSearch']
);

Route::get(
    '/getALLproductId/{id}',
    [GetProducts::class, 'getALlproductsForhomePageID']
);

Route::get(
    '/getGBlobalProduct/{first}/{second}',
    [GetProducts::class, 'getGBlobalProduct']
);

Route::get(
    '/getAlldetails/{id}',
    [GetProducts::class, 'getAlldetails']
);

Route::get(
    '/getALLYATTR/{cat}',
    [GetProducts::class, 'getALLYATTR']
);

Route::get(
    '/sendwinningMail/{article_id}',
    [mailsSender::class, 'sendMAiltowinner']
);

Route::get('/postio', [Rtest::class, 'testEvent']);

Route::get('/myemailverify', [Email_verif::class, 'index']);

Route::get('/confirmemail/{code}', [Email_verif::class, 'confirmemail']);

Route::get('/changepass/{email}', [Email_verif::class, 'changePass']);

Route::get('/updatepass/{pass}/{code}', [Email_verif::class, 'updatepass']);

Route::get('/testIfrequestExpire/{code}', [Email_verif::class, 'testIfrequestExpire']);

// Route::get('/paypal', [Paypal_::class, 'payp']);


// Route::middleware('throttle:120,1')->get('/broadcast/{id}/{category}', function (Request $request) {
//     // var_dump(openssl_get_cert_locations()); 
//     event(new Bid($request->id, $request->category));
//     return ["success" => true];
// });

Route::middleware('throttle:120,1')->get('/broadcast/{id}', function (Request $request) {
    // var_dump(openssl_get_cert_locations()); 
    event(new Bid($request->id));
    return ["success" => true];
});

Route::get('/app',  function () {
    return 'good';
});

Route::get('/testapi', [Calculation::class, 'calculateNextMinimumBid']);

Route::get('/getbidsonspace/{token}', [UserSpace::class, 'getBid']);

Route::get('/updatename/{firstname}/{lastname}/{token}', [UserSpace::class, 'updatename']);

Route::get('/userinfo/{token}', [UserSpace::class, 'getUserInfo']);

Route::get('/updateemail/{email}/{password}/{newemail}', [UserSpace::class, 'updateemail']);


Route::get('/updatepass/{password}/{newpassword}/{token}', [UserSpace::class, 'updatepass']);

Route::get('/getproductformanagement/{status}/{state}/{token}', [SellSpaceManagement::class, 'getPRoductformanagement']);

Route::get('/productajustement/{status}/{token}', [SellSpaceManagement::class, 'productajustement']);

Route::get('/productdeclined/{status}/{token}', [SellSpaceManagement::class, 'productdeclined']);

Route::get('/productpending/{status}/{token}', [SellSpaceManagement::class, 'productpending']);

//////////////////////////////////////////////////////////////////::////////////////////////////////////////////////////////

Route::post('/add_profil_image', [Add_User_Profil_Photo::class, 'add_user_image']);

Route::get('/get_profil_image/{token}', [Add_User_Profil_Photo::class, 'getProfilPhoto']);

Route::get('/get_profil_image_mail/{token}/{email}', [Add_User_Profil_Photo::class, 'getProfilPhoto_mail']);


Route::get('/getUserName/{token}', [Add_User_Profil_Photo::class, 'getUserName']);

Route::get('/getUserName_mail/{token}', [Add_User_Profil_Photo::class, 'getUserName_mail']);

Route::get('/getUserName_mail_visted_profil/{token}/{email}', [Add_User_Profil_Photo::class, 'getUserName_mail_visted_profil']);


Route::post('/add_teams', [Teams::class, 'add_teams']);

Route::get('/get_teams/{token}', [Teams::class, 'getTeams']);

Route::get('/deleteTeam/{token}/{id}', [Teams::class, 'deleteTeam']);

Route::get('/updatewithoutfiles/{token}/{id}/{city}/{team_name}/{sport_name}', [Teams::class, 'updatewithoutfiles']);

Route::post('/update_team_cover_image', [Teams::class, 'update_team_cover_image']);

Route::post('/update_team_logo_image', [Teams::class, 'update_team_logo_image']);

Route::get('/searchFriends/{lat}/{long}/{token}/{page}', [Interaction::class, 'searchFriends']);

Route::get('/searchFriendsNOlocation/{token}/{page}', [Interaction::class, 'searchFriendsNOlocation']);

Route::get('/searchWithInputWithlocation/{q}/{lat}/{long}/{token}/{page}', [Interaction::class, 'searchWithInputWithlocation']);

Route::get('/searchWithInputWithNolocation/{token}/{page}', [Interaction::class, 'searchWithInputWithNolocation']);

Route::get('/searchTeams/{lat}/{long}/{token}/{page}', [Interaction::class, 'searchTeams']);

Route::get('/followingSystem_insert/{email}/{token}', [Interaction::class, 'followingSystem_insert']);


Route::get('/followingSystem_check/{email}/{token}', [Interaction::class, 'followingSystem_check']);

Route::get('/followingSystem_check_2/{email}/{token}', [Interaction::class, 'followingSystem_check_2']);

Route::get('/adnotif/{notifToken}/{token}', [Interaction::class, 'adnotif']);

Route::get('/getNotifTokens/{token}/{email}', [Interaction::class, 'getNotifTokens']);


Route::get('/getRealtimeNotif/{token}/{page}', [Interaction::class, 'getRealtimeNotif']);

Route::get('/getRealtimeNotif_count/{token}', [Interaction::class, 'getRealtimeNotif_count']);



Route::get(
    '/addRealtimeNotif/{token}/{message}/{notification_actions}/{who}/{who_sent}',
    [Interaction::class, 'addRealtimeNotif']
);

Route::get('/checkme/{token}', [Interaction::class, 'checkme']);

Route::get('/getCurrentUsermail/{token}', [Interaction::class, 'getCurrentUsermail']);

Route::get('/markNotifasreaded/{token}', [Interaction::class, 'markNotifasreaded']);


Route::get('/joinATeam/{team_to_join}/{team_to_join_owner}/{token}/{id}', [Teams::class, 'joinATeam']);

Route::get('/checkTeamJoinedStatus/{team_to_join}/{team_to_join_owner}/{token}', [Teams::class, 'checkTeamJoinedStatus']);

Route::get('/getteammembers/{token}', [Teams::class, 'getteammembers']);

Route::get('/getteammembers__onTeamPage/{team_to_join}/{token}', [Teams::class, 'getteammembers__onTeamPage']);

Route::get('/acceptemembers/{id}/{token}', [Teams::class, 'acceptemembers']);

Route::get('/declinedmembers/{id}/{token}', [Teams::class, 'declinedmembers']);

Route::get('/getTeamIntegrated/{token}', [Teams::class, 'getTeamIntegrated']);

Route::get(
    '/askeforgame/{who_was_asked}/{date_of_game}/{hours_of_game}/{place_of_game}/{team_of_asker}/{team_of_who_was_asked}/{token}',
    [Teams::class, 'askeforgame']
);

Route::get('/getAskGames/{page}/{token}/{status}', [Teams::class, 'getAskGames']);

Route::get('/getMyAskGames/{page}/{token}/{status}', [Teams::class, 'getMyAskGames']);


Route::get(
    '/updateAskGames/{date_of_game}/{hours_of_game}/{place_of_game}/{id}/{token}',
    [Teams::class, 'updateAskGames']
);

Route::get(
    '/accepteAskGames/{id}/{token}',
    [Teams::class, 'accepteAskGames']
);

Route::get(
    '/refuseAskGames/{id}/{token}',
    [Teams::class, 'refuseAskGames']
);

Route::get(
    '/addTeamRates/{wichteamrated}/{punctuality}/{fair_play}/{team_rated_name}/{status}/{game_id}/{token}',
    [Teams::class, 'addTeamRates']
);

Route::get(
    '/addWinner/{game_id}/{score}/{winner_mail}/{winner_team}/{score_2}/{status}/{token}',
    [Teams::class, 'addWinner']
);

Route::get(
    '/addLooser/{game_id}/{score}/{looser_mail}/{looser_team}/{score_2}/{status}/{token}',
    [Teams::class, 'addLooser']
);

Route::get(
    '/addDraw/{game_id}/{score}/{mail}/{team}/{status}/{token}',
    [Teams::class, 'addDraw']
);

Route::get(
    '/refuseScore/{game_id}/{token}',
    [Teams::class, 'refuseScore']
);
Route::get(
    '/accepteScore/{game_id}/{token}',
    [Teams::class, 'accepteScore']
);


Route::get(
    '/getfinishGames/{token}',
    [Teams::class, 'getfinishGames']
);

Route::get(
    '/getAVGOfTeamRates/{team}/{token}',
    [Teams::class, 'getAVGOfTeamRates']
);

Route::get(
    '/palmares/{team}/{page}/{years}/{season}/{token}',
    [Teams::class, 'palmares']
);

Route::post('/add_post', [Post::class, 'add_post']);

Route::get('/get_post/{token}/{who}', [Post::class, 'getPost']);

Route::get('/getpostonfield/{token}', [Post::class, 'getPostONfield']);
Route::get('/add_likes/{post_id}/{token}', [Post::class, 'addLikes']);
Route::get('/add_comments/{post_id}/{comment}/{token}', [Post::class, 'addComments']);
Route::get('/get_comments/{post_id}/{token}', [Post::class, 'getComments']);
// 

// {title}/{who_can_see}/{status}/{token}

// Route::get(
//     '/addRealtimeNotif/{message}',
//     [Interaction::class, 'addRealtimeNotif']
// );


/**
 * le systeme de following
 * qui me suit = email = followed_user
 * 
 * est que j'ai accèpter = bool = 01 = 
 * 
 * qui je suit = email = following_user
 * 
 * es qu'il a accepter = bool  = 01
 * 
 * 
 */


// type de notification
/**
 * Notification avec action 
 * Notification sans action
 */
