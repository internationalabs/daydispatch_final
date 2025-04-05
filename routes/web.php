<?php

use App\{
    Http\Controllers\AuthController,
    Http\Controllers\MainController,
    Http\Controllers\Payment\PayPalPaymentController,
    Http\Controllers\Payment\StripePaymentController,
    Http\Controllers\TestingController,

    Http\Livewire\Auth\AdminLoginForm,
    Http\Livewire\Auth\AdminRegistration,
    Http\Livewire\Auth\AgentLoginForm,
    Http\Livewire\Auth\AgentRegistration,
    Http\Livewire\Auth\AuthorizedForgotPassword,
    Http\Livewire\Auth\AuthorizeRecoverPassword,
    Http\Livewire\Auth\LoginForm,
    Http\Livewire\Auth\UserRegistration,
    Http\Livewire\Backend\Admin\AdminDashboard,
    Http\Livewire\Backend\Admin\Agreement\UserOrderAgreement,
    Http\Livewire\Backend\Admin\Permissions\AllAgentsPermissions,
    Http\Livewire\Backend\Admin\Permissions\AllPermissions,
    Http\Livewire\Backend\Admin\Frontend\WebsiteLeads,
    Http\Livewire\Backend\Admin\Invoices\AllInvoices,
    Http\Livewire\Backend\Admin\History\FilterHistoryComment,
    Http\Livewire\Backend\Admin\History\CarriersHistory,
    Http\Livewire\Backend\Admin\History\LogisticCarriersHistory,
    Http\Livewire\Backend\Admin\History\LogisticBrokersHistory,
    Http\Livewire\Backend\Admin\History\LogisticShippersHistory,
    Http\Livewire\Backend\Admin\Listing\AllArchived,
    Http\Livewire\Backend\Admin\Listing\AllCancelled,
    Http\Livewire\Backend\Admin\Listing\AllCompleted,
    Http\Livewire\Backend\Admin\Listing\AllDeliverApproval,
    Http\Livewire\Backend\Admin\Listing\AllDelivered,
    Http\Livewire\Backend\Admin\Listing\AllDispatches,
    Http\Livewire\Backend\Admin\Listing\AllExpired,
    Http\Livewire\Backend\Admin\Listing\AllListing,
    Http\Livewire\Backend\Admin\Listing\AllPickUp,
    Http\Livewire\Backend\Admin\Carriers\AllCarriersCompany,
    Http\Livewire\Backend\Admin\Carriers\AllLogisticShipper,
    Http\Livewire\Backend\Admin\Carriers\AllLogisticCarrier,
    Http\Livewire\Backend\Admin\Carriers\AllLogisticBroker,
    Http\Livewire\Backend\Admin\Carriers\FilterAgentCalls,
    Http\Livewire\Backend\Admin\Listing\AllPickupApproval,
    Http\Livewire\Backend\Admin\Listing\AllRequested,
    Http\Livewire\Backend\Admin\Listing\AllWaitingForApproval,
    Http\Livewire\Backend\Admin\Payments\PaymentSettings,
    Http\Livewire\Backend\Admin\Settings\SystemSettings,
    Http\Livewire\Backend\Admin\Support\AdminThreeWay,
    Http\Livewire\Backend\Admin\Support\AdminTicketDetail,
    Http\Livewire\Backend\Admin\UserProfiles\AdminEditUser,
    Http\Livewire\Backend\Admin\UserProfiles\AllUsers,
    Http\Livewire\Backend\Admin\UserProfiles\AllAdmins,
    Http\Livewire\Backend\Admin\ManagedCompanies\DispatcherList,
    Http\Livewire\Backend\Admin\ManagedCompanies\ManagedUsers,
    Http\Livewire\Backend\Admin\UserProfiles\ManageAgents,
    Http\Livewire\Backend\Agent\AgentDashboard,
    Http\Livewire\Backend\Agent\MyRewards,
    Http\Livewire\Backend\Agent\UserProfiles,
    Http\Livewire\Backend\Agent\Carriers,
    Http\Livewire\Backend\Agent\LogisticCarriers,
    Http\Livewire\Backend\Agent\LogisticBrokers,
    Http\Livewire\Backend\Agent\LogisticShippers,
    Http\Livewire\Backend\Agent\ViewProfiles,
    Http\Livewire\Backend\Contracts\OrderAgreement,
    Http\Livewire\Backend\Contracts\ViewOrderAgreement,
    Http\Livewire\Backend\Extras\AllTruckSpace,
    Http\Livewire\Backend\Extras\MyAllTrucks,
    Http\Livewire\Backend\Extras\FrieghtCalculator,
    Http\Livewire\Backend\Extras\GoogleTruckSpace,
    Http\Livewire\Backend\Extras\AllCompanyAdmin,
    Http\Livewire\Backend\Extras\SearchResults,
    Http\Livewire\Backend\Filters\ListingFilter,
    Http\Livewire\Backend\Invoices\PaymentInvoices,
    Http\Livewire\Backend\Listing\ArchieveListing,
    Http\Livewire\Backend\Listing\CancelledListing,
    Http\Livewire\Backend\Listing\DeletedListing,
    Http\Livewire\Backend\Listing\CompletedListing,
    Http\Livewire\Backend\Listing\DeliverApproval,
    Http\Livewire\Backend\Listing\DeliverdListing,
    Http\Livewire\Backend\Listing\DispatchListing,
    Http\Livewire\Backend\Listing\DirectDispatch,
    Http\Livewire\Backend\Listing\ReplicateListing,
    Http\Livewire\Backend\Listing\EditListing,
    Http\Livewire\Backend\Listing\ExpiredListing,
    Http\Livewire\Backend\Listing\ListingGallery,
    Http\Livewire\Backend\Listing\NewListing,
    Http\Livewire\Backend\Listing\PickupApproval,
    Http\Livewire\Backend\Listing\PickupListing,
    Http\Livewire\Backend\Listing\RequestedListing,
    Http\Livewire\Backend\Listing\UserDispatchListing,
    Http\Livewire\Backend\Listing\UserListing,
    Http\Livewire\Backend\Listing\PrivateListing,
    Http\Livewire\Backend\Listing\ApproveMisc,
    Http\Livewire\Backend\Listing\WishlistListing,
    Http\Livewire\Backend\Listing\WaitingForApprovals,
    Http\Livewire\Backend\Quote\NewQuote,
    Http\Livewire\Backend\Quote\TimelineQuote,
    Http\Livewire\Backend\Quote\OrderStatus,
    Http\Livewire\Backend\Quote\NewOrder,
    Http\Livewire\Backend\Quote\DeletedQuote,
    Http\Livewire\Backend\Quote\CancelledQuote,
    Http\Livewire\Backend\Quote\ArchieveQuote,
    Http\Livewire\Backend\Quote\CustomFolder,
    Http\Livewire\Backend\MyDispatching\DispatchedToMe,
    Http\Livewire\Backend\MyDispatching\MyCancelled,
    Http\Livewire\Backend\MyDispatching\MyCompleted,
    Http\Livewire\Backend\MyDispatching\MyDeliver,
    Http\Livewire\Backend\MyDispatching\MyDeliverApproval,
    Http\Livewire\Backend\MyDispatching\MyPickup,
    Http\Livewire\Backend\MyDispatching\MyPickupApproval,
    Http\Livewire\Backend\MyDispatching\MyRequested,
    Http\Livewire\Backend\MyDispatching\TimeQoute,
    Http\Livewire\Backend\MyDispatching\WaitingForMyApproval,
    Http\Livewire\Backend\Payments\LoadPackages,
    Http\Livewire\Backend\Payments\PricingPage,
    Http\Livewire\Backend\Profile\MyNotifications,
    Http\Livewire\Backend\Profile\UserProfile,
    Http\Livewire\Backend\Profile\UserRatings,
    Http\Livewire\Backend\Profile\MyReports,
    Http\Livewire\Backend\Profile\ViewProfile,
    Http\Livewire\Backend\Support\ThreeWaySupports,
    Http\Livewire\Backend\Support\TicketDetails,
    Http\Livewire\Backend\UserDashboard,
    Http\Livewire\Frontend\AboutUs,
    Http\Livewire\Frontend\ContactUs,
    Http\Livewire\Frontend\Dashboard,
    Http\Livewire\Frontend\FAQ,
    Http\Livewire\Frontend\GetQoute,
    Http\Livewire\Frontend\IsItForMe,
    Http\Livewire\Frontend\LoardBoard,
    Http\Livewire\Frontend\PrivacyPolicy,
    // Http\Livewire\Frontend\Packages,
    Http\Livewire\Frontend\TermsConditions,
    Http\Livewire\Frontend\FlatbedTrailer,
    Http\Livewire\Frontend\ReeferContainers,
    Http\Livewire\Frontend\PowerOnly,
    Http\Livewire\Frontend\LandollTrailers,
    Http\Livewire\Frontend\HopperBottomTrailer,
    Http\Livewire\Frontend\Titans,
    Http\Livewire\Frontend\Dumptrucks,
    Http\Livewire\Frontend\HassleFree,
    Http\Livewire\Frontend\CargoVan,
    Http\Livewire\Frontend\StraightBoxTrucks,
    Http\Livewire\Frontend\Truckload_shipping,
    Http\Livewire\Frontend\Carrier,
    Http\Livewire\Frontend\Broker,
    Http\Livewire\Frontend\Shipper,
    Services\CreateUpdateListing,
    Services\CreateUpdateQuote,
    Services\DayDispatchServices
};
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\BorderWaitTime;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\TaskCalendarFolder\TaskCalendarController;
use App\Http\Controllers\Backend\Listing\OnlineBolController;
use App\Http\Controllers\CustomerFeedback;
use App\Http\Controllers\NumberOfLogin\NumberOfLoginController;

use App\Http\Controllers\OrderFormController;
use App\Http\Controllers\OrderFormPaymentController;
use App\Http\Controllers\OrderFormSettingController;

use App\Http\Controllers\SidebarOptionController;
use App\Http\Controllers\RemoveVehicleController;
use App\Http\Controllers\SearchLoadsController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\LoadboardRoleController;
use App\Http\Controllers\UserSheetController;
use App\Models\Quote\Order;
use App\Models\SidebarOption;

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

// ================ Cache Clear Routes
Route::get('/clear-cache', static function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('event:clear');
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});

// ===================== Frontend Website Routes ======================
Route::get('/', Dashboard::class)->name('Frontend.index');
Route::get('/about_us', AboutUs::class, )->name('Frontend.about.us');
Route::get('/Is-It-For-Me', IsItForMe::class, )->name('Frontend.is.me');
Route::get('/Load-Board', LoardBoard::class, )->name('Frontend.loadboard');
Route::get('/Quote-Request', GetQoute::class, )->name('Frontend.qoute.request');
Route::get('/Contact-Us', ContactUs::class, )->name('Frontend.contact.us');
Route::get('/Terms-Conditions', TermsConditions::class, )->name('Frontend.terms');
Route::get('/Frequently-Asked-Questions', FAQ::class, )->name('Frontend.faq');
Route::get('/Privacy-Policy', PrivacyPolicy::class, )->name('Frontend.privacy');
Route::get('/Carriers', Carrier::class, )->name('Frontend.Carrier');
Route::get('/Brokers', Broker::class, )->name('Frontend.Broker');
Route::get('/Shippers', Shipper::class, )->name('Frontend.Shipper');
Route::get('/LoadBoard_Packages', [PackagesController::class, 'index'])->name('Frontend.Packages');
Route::get('/Dispatch', [DispatchController::class, 'index'])->name('Frontend.Dispatch');
Route::get('/Testimonials', [TestimonialController::class, 'index'])->name('Frontend.Testimonials');


// ===================Front End Blogs Pages ============================
Route::group(['prefix' => 'Blog'], static function () {
    // Route::get('/', static function () {
    //     $slot = '';
    //     // return view('livewire.frontend.blog.index', compact('slot'));
    //     return view('livewire.frontend.blog.index')->layout('layouts.master');
    // });
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/Flatbed-Trailer', FlatbedTrailer::class, )->name('Frontend.FlatbedTrailer');

    Route::get('/Reefer-Containers', ReeferContainers::class, )->name('Frontend.ReeferContainers');
    Route::get('/Power-Only', PowerOnly::class, )->name('Frontend.PowerOnly');
    Route::get('/Landoll-Trailers', LandollTrailers::class, )->name('Frontend.LandollTrailers');
    Route::get('/HopperBottom-Trailer', HopperBottomTrailer::class, )->name('Frontend.HopperBottomTrailer');
    Route::get('/Titans', Titans::class, )->name('Frontend.Titans');
    Route::get('/Dump-Trucks', Dumptrucks::class, )->name('Frontend.Dumptrucks');
    Route::get('/Hassle-Free', HassleFree::class, )->name('Frontend.HassleFree');
    Route::get('/Cargo-Van', CargoVan::class, )->name('Frontend.CargoVan');
    Route::get('/Straight-Box-Trucks', StraightBoxTrucks::class, )->name('Frontend.StraightBoxTrucks');
    Route::get('/Truckload_shipping', Truckload_shipping::class, )->name('Frontend.Truckload_shipping');
    Route::get('/{id}', [TestingController::class, 'blogDetails'])->name('blogDetails');
});

// USER BOL LISTING
Route::get('/Online-Bol/{List_ID}', [OnlineBolController::class, 'OnlineBol'])->name('User.Bol.Listing');
Route::get('/Online-Bol-2', static function () {
    return view('livewire.backend.listing.online-bol-2')->layout('layouts.authorized');
});
Route::post('/store-Online-Bol', [OnlineBolController::class, 'StoreOnlineBol'])->name('store.online.bol');

Route::get('/PostPickup-Online-Bol/{List_ID}', [OnlineBolController::class, 'PickupOnlineBol'])->name('PostPickup.Bol.Listing');

Route::post('/Pickup-Store-Online-Bol', [OnlineBolController::class, 'PickupStoreOnlineBol'])->name('pickup.store.online.bol');

Route::get('/Final-Online-Bol/{List_ID}', [OnlineBolController::class, 'FinalOnlineBol'])->name('Final.Bol.Listing');

// Authorization Form
Route::get('/Authorization-Form', [AllUsers::class, 'authorizationForm'])->name('Authorization.Form');
Route::post('/Authorization-Form/Submit', [AllUsers::class, 'authorizationFormSubmit'])->name('authorization.form.submit');
Route::post('/Authorization-Form/Email', [AllUsers::class, 'authorizationFormEmail'])->name('authorization.form.email');

// Authorization Form Submit
Route::get('/authorization-forms', [AllUsers::class, 'allForms'])->name('authorization.forms.index');


Route::post('/Post-Instant-Quote', [Dashboard::class, 'postInstantQuote'])->name('Post.Instant.Quote');
Route::post('/Post-Custom-Order-Track', [GetQoute::class, 'postCustomOrderTracking'])->name('Post.Custom.Track.Order');
Route::post('/Submit-Contact-Lead', [ContactUs::class, 'postContactLead'])->name('Post.Contact.Lead');

// ===================== Admin Auth Routes ==================================
Route::prefix('Authenticate')->group(function () {
    Route::get('/Login-Form', AdminLoginForm::class, )->name('Auth.Admin.Forms');
    Route::post('/Login-Form-Submit', [AdminLoginForm::class, 'AdminLogin'])->name('Auth.Admin');

    Route::get('/Register-Admin', AdminRegistration::class, )->name('Auth.New.Admin');
    Route::post('/Register-Admin-Submit', [AdminRegistration::class, 'AdminRegistration'])->name('Auth.Reg.Admin');
});

// ================== Backend Admin Authorized Routes =====================
Route::group(['middleware' => 'AdminAuthorized', 'prefix' => 'Admin'], static function () {
    Route::get('/Website-Leads', WebsiteLeads::class, )->name('Website.Leads');
    Route::get('/', AdminDashboard::class, )->name('Admin.Dashboard');

    //    ==================== Users Views For Admin ============
    Route::get('/All-Admins-List', AllAdmins::class, )->name('All.Admins');
    Route::post('/All-Admins/Permission/Store', [AllAdmins::class, 'store'])->name('Store.Admin.Permission');
    Route::get('/All-Admins/Permission/All', [AllAdmins::class, 'getChecked'])->name('Get.Admin.Permission');

    //    ==================== Users Views For Admin ============
    Route::get('/All-Users-List', AllUsers::class, )->name('All.Users');
    Route::get('/Verify-User/{User_ID}', [AllUsers::class, 'VerifyUser'])->name('Verify.User');
    Route::get('/Un-Verify-User/{User_ID}', [AllUsers::class, 'un_VerifyUser'])->name('Un.Verify.User');
    Route::get('/Suspend-User/{User_ID}', [AllUsers::class, 'SuspendUser'])->name('Suspend.User');
    Route::get('/Un-Suspend-User/{User_ID}', [AllUsers::class, 'un_SuspendUser'])->name('Un.Suspend.User');
    Route::get('/Admin-View-Profile/{User_ID}/{USR_TYPE}', AdminEditUser::class, )->name('Admin.View.Profile');
    Route::post('/Edit-User-Basic-Info/{User_ID}/{USR_TYPE}', [AdminEditUser::class, 'EditUserBasicInfo'])->name('Edit.User.Basic.Info');
    Route::post('/Edit-User-Insurance/{User_ID}/{USR_TYPE}', [AdminEditUser::class, 'EditUserInsurance'])->name('Edit.User.Insurance.Info');
    Route::get('/Email-Notification-Switch', [AdminEditUser::class, 'UserEmailNotificationSwitch'])->name('User.Email.Notification.Switch');
    Route::get('/Custom-Notification-Switch', [AdminEditUser::class, 'UserCustomNotificationSwitch'])->name('User.Custom.Notification.Switch');
    Route::post('/Edit-User-Access/{User_ID}/{USR_TYPE}', [AdminEditUser::class, 'EditUserAccess'])->name('Edit.User.Access');
    Route::post('/Edit-User-Other/{User_ID}/{USR_TYPE}', [AdminEditUser::class, 'EditUserOther'])->name('Edit.User.Other');

    //    ==================== Managed Users/Companies ============
    Route::get('/All-Dispatch-List', DispatcherList::class, )->name('All.Dispatch');
    Route::get('/All-Managed-Companies', ManagedUsers::class, )->name('All.Managed.Companies');
    Route::post('/Assign-Company-to-Dispatcher/{User_ID}/{USR_TYPE}', [ManagedUsers::class, 'assignCompany'])->name('Assign.Company.Dispatcher');
    Route::get('/Remove-Company-Dispatcher/{User_ID}/{USR_TYPE}', [ManagedUsers::class, 'removeAccess'])->name('Admin.Remove.Access');

    //    ==================== Agent Views For Admin ============
    Route::post('/Edit-Agent-Basic-Info/{User_ID}/{USR_TYPE}', [AdminEditUser::class, 'EditAgentBasicInfo'])->name('Edit.Agent.Basic.Info');
    //    ==================== Manage Payments For Admin ============
    Route::get('/Payment-Settings', PaymentSettings::class, )->name('Payment.Settings');
    Route::get('/Payment-Switch-Update', [PaymentSettings::class, 'PaymentSwitchUpdate'])->name('Payment.Switch.Update');
    Route::get('/Payment-Subscription-Update', [PaymentSettings::class, 'SubscriptionPackage'])->name('Subscription.Update');
    Route::get('/Revenue-Target-Update', [PaymentSettings::class, 'RevenueTarget'])->name('Target.Revenue.Update');
    Route::get('/User-Invoices', AllInvoices::class, )->name('Users.Invoices');

    //    ==================== Listing Views For Admin ============
    Route::get('/Admin-Listing', AllListing::class, )->name('Admin.Listing');
    Route::get('/Admin-Waiting-Listing', AllWaitingForApproval::class, )->name('Admin.WaitingListing');
    Route::get('/Admin-Requested', AllRequested::class, )->name('Admin.Requested');
    Route::get('/Admin-Dispatches', AllDispatches::class, )->name('Admin.Dispatches');
    Route::get('/Admin-Pickup-Approval', AllPickupApproval::class, )->name('Admin.PickUp.Approval');
    Route::get('/Admin-Pickup', AllPickUp::class, )->name('Admin.PickUp');
    Route::get('/Admin-Deliver-Approval', AllDeliverApproval::class, )->name('Admin.Deliver.Approval');
    Route::get('/Admin-Delivered', AllDelivered::class, )->name('Admin.Delivered');
    Route::get('/Admin-Completed', AllCompleted::class, )->name('Admin.Completed');
    Route::get('/Admin-Cancelled', AllCancelled::class, )->name('Admin.Cancelled');
    Route::get('/Admin-Expired', AllExpired::class, )->name('Admin.Expired');
    Route::get('/Admin-Archived', AllArchived::class, )->name('Admin.Archived');
    Route::get('/Admin-Carriers', AllCarriersCompany::class, )->name('Admin.Carriers');
    Route::post('/Admin-Carriers/store', [AllCarriersCompany::class, 'AllCarriersStore'])->name('Admin.Carriers.Store');
    Route::get('/All-Companies', AllCompanyAdmin::class, )->name('Admin.All-Companies');

    Route::get('/Admin-Logistic-Shippers', AllLogisticShipper::class, )->name('Admin.Logistic.Shippers');
    Route::post('/Admin-Logistic-Shippers/store', [AllLogisticShipper::class, 'AllLogShipperStore'])->name('Admin.LogShipper.Store');
    Route::get('/Admin-Logistic-Carrier', AllLogisticCarrier::class, )->name('Admin.Logistic.Carrier');
    Route::post('/Admin-Logistic-Carrier/store', [AllLogisticCarrier::class, 'AllLogCarrierStore'])->name('Admin.LogCarrier.Store');
    Route::get('/Admin-Logistic-Broker', AllLogisticBroker::class, )->name('Admin.Logistic.Broker');
    Route::post('/Admin-Logistic-Broker/store', [AllLogisticBroker::class, 'AllLogBrokerStore'])->name('Admin.LogBroker.Store');
    Route::post('/Admin-Pass-Check', [AllCarriersCompany::class, 'passCheck'])->name('Admin.Pass.Check');

    //    ==================== Call History For Admin ============
    Route::get('/Admin/History/Carrier', [AllCarriersCompany::class, 'history'])->name('Admin.History.Carrier');
    Route::get('/Admin/History/Logistic-Broker', [AllLogisticBroker::class, 'history'])->name('Admin.History.Logistic.Broker');
    Route::get('/Admin/History/Logistic-Carrier', [AllLogisticCarrier::class, 'history'])->name('Admin.History.Logistic.Carrier');
    Route::get('/Admin/History/Logistic-Shippers', [AllLogisticShipper::class, 'history'])->name('Admin.History.Logistic.Shippers');

    //    ==================== Agents Views For Admin ============
    Route::get('/Filter/Agents-calls', FilterAgentCalls::class, )->name('Filter.Agents.Calls');
    Route::get('/Filter/Agents-calls/Results', [FilterAgentCalls::class, 'filter'])->name('Filter.Agents.Calls.Results');

    //    ==================== Agents Views For Admin ============
    Route::get('/All-Agents-List', ManageAgents::class, )->name('All.Agents');

    //    ==================== All-Permissions Views For Admin ============
    Route::get('/All-Permissions-List', AllPermissions::class, )->name('All.Permissions');
    Route::post('/Permission/Store', [AllPermissions::class, 'store'])->name('Admin.Permissions.Store');

    //    ==================== All-Agents-Permissions Views For Admin ============
    Route::get('/All-Agents-Permissions-List', AllAgentsPermissions::class, )->name('All.Agents.Permissions');
    Route::post('/AgentsPermission/Store', [AllAgentsPermissions::class, 'store'])->name('Admin.AgentPermission.Store');
    Route::get('/Get-Carrier-States', [AllAgentsPermissions::class, 'getStates'])->name('Admin.Carrier.States');
    Route::get('/AgentsPermission/Delete', [AllAgentsPermissions::class, 'destroy'])->name('Admin.AgentPermission.Delete');

    //    ==================== 3-Way Support Views For Admin ============
    Route::get('/All-Tickets', AdminThreeWay::class, )->name('Admin.All.Tickets');
    Route::get('/Admin-Ticket-Details/{Ticket_ID}', AdminTicketDetail::class)->name('Admin.Ticket.Details');
    Route::post('/Admin-Post-Order-Ticket-Comments', [AdminTicketDetail::class, 'PostComments'])->name('Admin.Post.Comments');
    Route::post('/Admin-Post-Order-Ticket-Comments-Replied', [AdminTicketDetail::class, 'PostCommentsReplied'])->name('Admin.Post.Comments.Replied');
    Route::get('/Admin-Ticket-Status-Update', [AdminTicketDetail::class, 'TicketStatusUpdate'])->name('Admin.Ticket.Status.Update');

    //    ==================== System Settings Views For Admin ============
    Route::get('/All-Settings', SystemSettings::class, )->name('All.Settings');

    Route::post('/Add-Misc-Item', [SystemSettings::class, 'addMiscItems'])->name('Add.Misc.Items');
    Route::get('/Delete-Misc-Item/{Misc_ID}', [SystemSettings::class, 'deleteMiscItems'])->name('Delete.Misc.Items');
    Route::post('/Add-User-Role', [SystemSettings::class, 'addUserRole'])->name('Add.User.Role');
    Route::get('/Delete-User-Role/{Role_ID}', [SystemSettings::class, 'deleteUserRole'])->name('Delete.User.Role');
    Route::post('/Add-New-User', [SystemSettings::class, 'AdminRegistration'])->name('Add.New.User');
    Route::post('/Add-New-WebUser', [SystemSettings::class, 'UserRegistration'])->name('Add.New.WebUser');
    Route::post('/Add-Admin-Permissions', [SystemSettings::class, 'AddAdminPermissions'])->name('Add.Admin.Permissions');
    Route::post('/Add-Admin-Permission/Store', [SystemSettings::class, 'storePermission'])->name('Add.New.Permission');
    Route::get('/Delete-Admin-Permission/{id}', [SystemSettings::class, 'deletePermission'])->name('Delete.Admin.Permission');
    Route::post('/Add-Admin-IP', [SystemSettings::class, 'storeIP'])->name('Add.Admin.Ip');
    Route::get('/Delete-Admin-IP/{id}', [SystemSettings::class, 'deleteIP'])->name('Delete.Admin.Ip');

    Route::get('/User-Order-Agreement/{List_ID}', UserOrderAgreement::class)->name('User.Order.Agreement');

    Route::get('/Admin-LogOut', [AdminLoginForm::class, 'AdminLogout'])->name('Admin.LogOut');

    // Admin View History
    Route::get('/View/All-Carriers/History', CarriersHistory::class, )->name('Admin.carriers.History');
    Route::get('/View/All-Logistic-Carriers/History', LogisticCarriersHistory::class, )->name('Admin.logisticCarriers.History');
    Route::get('/View/All-Logistic-Brokers/History', LogisticBrokersHistory::class, )->name('Admin.logisticBrokers.History');
    Route::get('/View/All-Logistic-Shippers/History', LogisticShippersHistory::class, )->name('Admin.logisticShippers.History');

    // History Comment
    Route::get('/Get/All-Carriers/Comment', [CarriersHistory::class, 'getComment'])->name('Admin.carriers.Comment.Get');
    Route::get('/Get/All-Logistic-Carriers/Comment', [LogisticCarriersHistory::class, 'getComment'])->name('Admin.logisticCarriers.Comment.Get');
    Route::get('/Get/All-Logistic-Brokers/Comment', [LogisticBrokersHistory::class, 'getComment'])->name('Admin.logisticBrokers.Comment.Get');
    Route::get('/Get/All-Logistic-Shippers/Comment', [LogisticShippersHistory::class, 'getComment'])->name('Admin.logisticShippers.Comment.Get');
    Route::post('/Store/All-Carriers/Comment', [CarriersHistory::class, 'storeComment'])->name('Admin.carriers.Comment');
    Route::post('/Store/All-Logistic-Carriers/Comment', [LogisticCarriersHistory::class, 'storeComment'])->name('Admin.logisticCarriers.Comment');
    Route::post('/Store/All-Logistic-Brokers/Comment', [LogisticBrokersHistory::class, 'storeComment'])->name('Admin.logisticBrokers.Comment');
    Route::post('/Store/All-Logistic-Shippers/Comment', [LogisticShippersHistory::class, 'storeComment'])->name('Admin.logisticShippers.Comment');

    Route::get('/Filter-History-Comment', FilterHistoryComment::class)->name('Filter.Comment.History');
    Route::get('/Filter/History-Comment/Results', [FilterHistoryComment::class, 'filter'])->name('Filter.Comment.History.Results');

    // get single history in modal
    Route::get('/getCarrierHistory', [FilterHistoryComment::class, 'getCarrierHistory'])->name('get.single.CarrierHistory');
    Route::get('/getLogBrokerHistory', [FilterHistoryComment::class, 'getLogBrokerHistory'])->name('get.single.LogBrokerHistory');
    Route::get('/getLogCarrierHistory', [FilterHistoryComment::class, 'getLogCarrierHistory'])->name('get.single.LogCarrierHistory');
    Route::get('/getLogShipperHistory', [FilterHistoryComment::class, 'getLogShipperHistory'])->name('get.single.LogShipperHistory');

    //Group chats
    Route::get('/Group', [GroupController::class, 'index'])->name('chat.group.index');
    Route::post('/Group/store', [GroupController::class, 'store'])->name('chat.group.store');
    Route::get('/Group/destroy/{id}', [GroupController::class, 'destroy'])->name('chat.group.destroy');
    Route::get('/Group/active/{id}', [GroupController::class, 'active'])->name('chat.group.active');
    Route::get('/Group/notActive/{id}', [GroupController::class, 'notActive'])->name('chat.group.notActive');
    Route::get('/Group/edit/{id}', [GroupController::class, 'edit'])->name('chat.group.edit');
    Route::put('/Group/update/{id}', [GroupController::class, 'update'])->name('chat.group.update');

    //Group chats
    Route::get('/load-board', [LoadboardRoleController::class, 'index'])->name('loadboard.roles');
    Route::post('/load-board/store', [LoadboardRoleController::class, 'store'])->name('loadboard.roles.store');
    Route::get('/load-board/destroy/{id}', [LoadboardRoleController::class, 'destroy'])->name('loadboard.roles.destroy');
    Route::get('/load-board/active/{id}', [LoadboardRoleController::class, 'active'])->name('loadboard.roles.active');
    Route::get('/load-board/notActive/{id}', [LoadboardRoleController::class, 'notActive'])->name('loadboard.roles.notActive');
    Route::get('/load-board/edit/{id}', [LoadboardRoleController::class, 'edit'])->name('loadboard.roles.edit');
    Route::put('/load-board/update/{id}', [LoadboardRoleController::class, 'update'])->name('loadboard.roles.update');

    Route::get('/get_group_chat', [GroupController::class, 'get_group_chat'])->name('get_group_chat');
    Route::get('/get_group_chat_runtime', [GroupController::class, 'get_group_chat_runtime'])->name('get_group_chat_runtime');
    Route::get('/view_group_chat', [GroupController::class, 'view_group_chat'])->name('view_group_chat');
    Route::post('/save_group_chat', [GroupController::class, 'save_group_chat'])->name('save_group_chat');
    Route::get('/get_chat_group_unread', [GroupController::class, 'get_chat_group_unread'])->name('get_chat_group_unread');

    Route::get('/user-sheet', [UserSheetController::class, 'index'])->name('userSheet');
    Route::post('/user-sheet/store', [UserSheetController::class, 'store'])->name('userSheet.store');
    Route::get('/user-sheet/destroy/{id}', [UserSheetController::class, 'destroy'])->name('userSheet.destroy');
    Route::get('/user-sheet/active/{id}', [UserSheetController::class, 'active'])->name('userSheet.active');
    Route::get('/user-sheet/notActive/{id}', [UserSheetController::class, 'notActive'])->name('userSheet.notActive');
    Route::get('/user-sheet/edit/{id}', [UserSheetController::class, 'edit'])->name('userSheet.edit');
    Route::put('/user-sheet/update/{id}', [UserSheetController::class, 'update'])->name('userSheet.update');

    //    ==================== Customer Feedbacks ============
    Route::get('/All-Customer-Feedbacks', [CustomerFeedback::class, 'AllCustomerFeedbacks'])->name('All.Customer.Feedbacks');
});

// Change Password
Route::post('/change-password/', [MainController::class, 'changePassword'])->name('change.password');

// Change User Password
Route::post('/change-user-password/', [MainController::class, 'changeUserPassword'])->name('change.user.password');

// ===================== Agent Auth Routes ==================================
Route::prefix('Auth')->group(function () {
    Route::get('/Login-Form', AgentLoginForm::class, )->name('Auth.Agent.Forms');
    Route::post('/Login-Form-Submit', [AgentLoginForm::class, 'AgentLogin'])->name('Auth.Agent');

    Route::get('/Register-Agent', AgentRegistration::class, )->name('Auth.New.Agent');
    Route::post('/Register-Agent-Submit', [AgentRegistration::class, 'AgentRegistration'])->name('Auth.Reg.Agent');
});

// Remove Vehicle
Route::get('/Remove-Vehicle', [RemoveVehicleController::class, 'RemoveVehicle'])->name('Remove.Single.Vehicle');

// Chat Routes
Route::group(['middleware' => 'Authorized'], static function () {
    Route::get('/chat/{id?}', [ChatController::class, 'index'])->name('chat');
});
Route::get('/chat/users', [UserController::class, 'getUsers']);
Route::get('/chat/messages/{user}', [ChatController::class, 'getMessagesForUser']);
Route::post('/chat/send-message', [ChatController::class, 'sendMessage']);
Route::get('/chat-message/read/{id}', [ChatController::class, 'readMessage'])->name('chat.read');


// User Chat Broker Carrier
Route::get('/user-chats', [AdminChatController::class, 'userChats'])->name('user-chats');
// Route::get('/user_read_msg', [AdminChatController::class, 'userreadMsgs'])->name('user_read_msg');
Route::get('/user_get_chat', [AdminChatController::class, 'user_get_chat'])->name('user_get_chat');
Route::post('/user_save_chat', [AdminChatController::class, 'user_save_chat'])->name('user_save_chat');
Route::get('/user-get-chats', [AdminChatController::class, 'userChats22'])->name('user-get-chats');
Route::get('/user_get_chat_runtime', [AdminChatController::class, 'user_get_chat_runtime'])->name('user_get_chat_runtime');

// Admin Chat ichat
Route::get('/admin-chats', [AdminChatController::class, 'index'])->name('admin-chats');
Route::get('/admin-chats/user/{id}', [AdminChatController::class, 'index3']);
Route::get('/admin-chats/group/{id}', [AdminChatController::class, 'index3']);
Route::get('/get-chats', [AdminChatController::class, 'index22'])->name('get-chats');
Route::get('/read_msg', [AdminChatController::class, 'readMsgs'])->name('read_msg');
Route::post('/save_chat', [AdminChatController::class, 'save_chat'])->name('save_chat');
Route::get('/get_chat', [AdminChatController::class, 'get_chat'])->name('get_chat');
Route::get('/get_chat_runtime', [AdminChatController::class, 'get_chat_runtime'])->name('get_chat_runtime');
Route::get('/get_chat2', [AdminChatController::class, 'get_chat2'])->name('get_chat2');
Route::get('/view_chat_timer', [AdminChatController::class, 'view_chat_timer'])->name('view_chat_timer');
Route::get('/view_chat', [AdminChatController::class, 'view_chat'])->name('view_chat');
Route::get('/get_chat_unread', [AdminChatController::class, 'get_chat_unread'])->name('get_chat_unread');

Route::get('/chat-noti', [AdminChatController::class, 'chatNoti'])->name('chat_noti');
Route::get('/chat-noti-count', [AdminChatController::class, 'chatNotiCount'])->name('chat_noti_count');

// ================== Backend Agent Authorized Routes =====================
Route::group(['middleware' => 'AgentAuthorized', 'prefix' => 'Agent'], function () {
    Route::get('/', AgentDashboard::class, )->name('Agent.Dashboard');

    Route::get('/Manage-Users-List', UserProfiles::class, )->name('Agent.Users');

    Route::get('/All-Carriers', Carriers::class, )->name('Agent.carriers');
    Route::get('/All-Logistic-Carriers', LogisticCarriers::class, )->name('Agent.logisticCarriers');
    Route::get('/All-Logistic-Brokers', LogisticBrokers::class, )->name('Agent.logisticBrokers');
    Route::get('/All-Logistic-Shippers', LogisticShippers::class, )->name('Agent.logisticShippers');

    // Comments/ History of Calls/Carriers/Brokers/Shippers
    Route::post('/All-Carriers/History/Store', [Carriers::class, 'storeHistory'])->name('Agent.carriers.History.Store');
    Route::post('/All-Logistic-Carriers/History/Store', [LogisticCarriers::class, 'storeHistory'])->name('Agent.logisticCarriers.History.Store');
    Route::post('/All-Logistic-Brokers/History/Store', [LogisticBrokers::class, 'storeHistory'])->name('Agent.logisticBrokers.History.Store');
    Route::post('/All-Logistic-Shippers/History/Store', [LogisticShippers::class, 'storeHistory'])->name('Agent.logisticShippers.History.Store');

    // Add count of Calls/Carriers/Brokers/Shippers
    Route::get('/All-Carriers/Add/CallCount', [Carriers::class, 'addCallCount'])->name('Agent.carriers.Call.Count');
    Route::get('/All-Logistic-Carriers/Add/CallCount', [LogisticCarriers::class, 'addCallCount'])->name('Agent.logisticCarriers.Call.Count');
    Route::get('/All-Logistic-Brokers/Add/CallCount', [LogisticBrokers::class, 'addCallCount'])->name('Agent.logisticBrokers.Call.Count');
    Route::get('/All-Logistic-Shippers/Add/CallCount', [LogisticShippers::class, 'addCallCount'])->name('Agent.logisticShippers.Call.Count');

    // Retrieve History of Carriers/Brokers/Shippers
    Route::get('/All-Carriers/History/Retrieve', [Carriers::class, 'getHistory'])->name('Agent.carriers.Retrieve.History');
    Route::get('/All-Logistic-Carriers/History/Retrieve', [LogisticCarriers::class, 'getHistory'])->name('Agent.logisticCarriers.Retrieve.History');
    Route::get('/All-Logistic-Brokers/History/Retrieve', [LogisticBrokers::class, 'getHistory'])->name('Agent.logisticBrokers.Retrieve.History');
    Route::get('/All-Logistic-Shippers/History/Retrieve', [LogisticShippers::class, 'getHistory'])->name('Agent.logisticShippers.Retrieve.History');

    Route::get('/Agent-View-Profile/{User_ID}/{USR_TYPE}', ViewProfiles::class, )->name('Agent.View.Profile');

    Route::get('/Manage-Revenue-Records', MyRewards::class, )->name('Agent.Revenue');

    Route::get('/Agent-LogOut', [AgentLoginForm::class, 'AgentLogout'])->name('Agent.LogOut');
});

// ===================== User Auth Routes ==================================
Route::prefix('Authentication')->group(callback: function () {
    Route::get('/Login-Form', LoginForm::class, )->name('Auth.Forms');
    Route::post('/Login-Form', [LoginForm::class, 'UserLogin'])->name('Auth.User');
    Route::get('/verify-login/{user_id}', [LoginForm::class, 'verifyLoginOtpForm'])->name('Auth.Login.OTPForm');
    Route::post('/verify-login', [LoginForm::class, 'verifyLogin'])->name('Auth.Login.OTP');

    Route::get('/resend-otp', [LoginForm::class, 'resendOTP'])->name('Auth.Resend.OTP');

    Route::get('/Register-User', UserRegistration::class, )->name('Auth.New.User');
    Route::post('/Register-User-Submit', [UserRegistration::class, 'UserRegistration'])->name('Auth.Reg.User');
    Route::get('/verify-otp/{user_id}', [UserRegistration::class, 'verifyOtpForm'])->name('Auth.OTPForm');
    Route::post('/verify-otp', [UserRegistration::class, 'verifyOtp'])->name('Auth.verifyOtp');

    Route::get('/Forget-Password', AuthorizedForgotPassword::class, )->name('Forget.Password');
    Route::post('/Post-Forget-Password', [AuthorizedForgotPassword::class, 'submitForgetPasswordForm'])->name('Post.Forget.Password');
    Route::get('/Recover-Password/{token}', AuthorizeRecoverPassword::class, )->name('Recover.Password');
    Route::post('/Post-Reset-Password', [AuthorizeRecoverPassword::class, 'submitResetPasswordForm'])->name('Post.Reset.Password');

    Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
    // ======================= Payment Routes ==================
    Route::get('/Registration-Fee', PricingPage::class, )->name('User.Reg.Fee');
    Route::get('/Registration-Fee-Back', [PricingPage::class, 'BackFromRegFee'])->name('User.Reg.Log.Back');

    // Registration Fee Payment
    Route::post('/Stripe-Registration-Fee', [StripePaymentController::class, 'stripeRegistrationFee'])->name('Stripe.Registration');
    Route::get('/Stripe-Registration-Fee-Success/{User_ID}', [StripePaymentController::class, 'success'])->name('Stripe.Success');
    Route::get('/Stripe-Registration-Fee-Cancel', [StripePaymentController::class, 'cancel'])->name('Stripe.Cancel');

    Route::post('handle-payment', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
    Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
    Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');

    Route::get('/Payment-Response/{Transaction_ID}/{Transaction_Status}', PaymentInvoices::class)->name('success.payment.response');

    // Dispatch Fee Payment
    Route::get('dispatch-payment-success', [PayPalPaymentController::class, 'DispatchOrderFeeSuccess'])->name('dispatch.success.payment');
    Route::get('dispatch-cancel-payment', [PayPalPaymentController::class, 'DispatchOrderFeeCancel'])->name('dispatch.cancel.payment');

    Route::get('/Stripe-Dispatching-Fee-Success/{User_ID}', [StripePaymentController::class, 'DispatchOrderFeeSuccess'])->name('Dispatch.Stripe.Success');
    Route::get('/Stripe-Dispatching-Fee-Cancel', [StripePaymentController::class, 'DispatchOrderFeeCancel'])->name('Dispatch.Stripe.Cancel');

    // Subscription Fee Payment
    Route::get('package-payment-success', [PayPalPaymentController::class, 'SubscriptionSuccess'])->name('package.success.payment');
    Route::get('package-cancel-payment', [PayPalPaymentController::class, 'SubscriptionCancel'])->name('package.cancel.payment');

    Route::get('/Stripe-Package-Fee-Success/{User_ID}', [StripePaymentController::class, 'SubscriptionSuccess'])->name('Package.Stripe.Success');
    Route::get('/Stripe-Package-Fee-Cancel', [StripePaymentController::class, 'SubscriptionCancel'])->name('Package.Stripe.Cancel');
});

Route::get('/sidebar-options/create', [SidebarOptionController::class, 'create'])->name('sidebar-options.create');
Route::post('/sidebar-options/store', [SidebarOptionController::class, 'store'])->name('sidebar-options.store');
Route::get('/sidebar-options/edit/{id}', [SidebarOptionController::class, 'edit'])->name('sidebar-options.edit');
Route::post('/sidebar-options/update/{id}', [SidebarOptionController::class, 'update'])->name('sidebar-options.update');
Route::get('/sidebar-options/delete/{id}', [SidebarOptionController::class, 'delete'])->name('sidebar-options.delete');
Route::get('/sidebar-options/customer', OrderStatus::class)->name('sidebar-options.customer');


$sidebarOptions = SidebarOption::all();

foreach ($sidebarOptions as $option) {
    Route::get('/' . $option->route_name, function () use ($option) {
        return view('sidebar_options.show', ['option' => $option]);
    })->name($option->route_name);
}

Route::get('/checkout/success', function () {
    $UserRegFee = session('UserRegFee');
    return view('responses.checkout-success', compact('UserRegFee'))->layout('layouts.payment');
})->name('checkout.success');

// ================== Backend User Authorized Routes =====================
// Route::group(['middleware' => 'Authorized', 'prefix' => 'Authorized'], static function () {
Route::group(['middleware' => ['Authorized', 'check.logins'], 'prefix' => 'Authorized'], static function () {
        Route::get('/', UserDashboard::class, )->name('User.Dashboard');
    Route::get('/quote-dashboard', [UserDashboard::class, 'QuoteDashboard'])->name('Quote.Dashboard');
    Route::get('/quote_listing_status', [UserDashboard::class, 'getListingStats'])->name('Quote.Listing.Status');
    Route::get('/traffic-source', [UserDashboard::class, 'getTrafficSource'] )->name('Quote.getTrafficSource');
    Route::get('/Quote_inactive_customer', [UserDashboard::class, 'Quote_inactive_customer'] )->name('Quote.inactive.customers');
    Route::get('/Quote_CustomerDistribution', [UserDashboard::class, 'Quote_CustomerDistribution'] )->name('Quote.customer.distribution');

    //    ==================== User Profile Routes ============
    Route::get('/User-Profile', UserProfile::class, )->name('User.Profile');
    Route::post('/User-Profile-Update', [UserProfile::class, 'UpdateUserProfile'])->name('User.Profile.Update');
    Route::post('/User-Notification-Update', [UserProfile::class, 'UpdateUserNotification'])->name('User.Notification.Update');
    Route::post('/User-Contract', [UserProfile::class, 'addMyContract'])->name('User.Contract');
    Route::post('/User-Address-Book', [UserProfile::class, 'addNewContact'])->name('User.New.Contact');
    Route::get('/User-Delete-Contact/{contact_id}', [UserProfile::class, 'deleteContact'])->name('User.Delete.Contact');
    Route::post('/User-Search-Results', SearchResults::class, )->name('User.Company.Search');
    Route::post('/User-Network-Post', [UserProfile::class, 'addMyNetwork'])->name('User.Add.Network');
    Route::post('/User-Network-Blocked-Post', [UserProfile::class, 'blockedMyNetwork'])->name('User.Blocked.Network');
    Route::get('/User-Network-Update/{id}', [UserProfile::class, 'updateMyNetwork'])->name('User.Update.Network');
    Route::get('/User-Contract-Delete/{contract_id}', [UserProfile::class, 'deleteContract'])->name('User.Delete.Contract');

    Route::post('/User-Add-Disputes', [UserProfile::class, 'addDisputes'])->name('User.Add.Disputes');
    Route::get('/User-View-Disputes', [UserProfile::class, 'viewDisputes'])->name('User.View.Disputes');
    Route::get('/User-Documents-Update/{user_id}/{doc_id}/{doc_type}', [UserProfile::class, 'updateDocumentStatus'])->name('User.Update.Documents');

    Route::post('/User-Certificate-Assign', [UserProfile::class, 'UserCertificateAssign'])->name('User.Certificate.Assign');

    // User My Reports
    Route::get('/View-MyReports', MyReports::class)->name('View.MyReports');
    Route::get('/Search-MyReports/', [MainController::class, 'getListingCounts'])->name('View.MyReports.GetCount');
    Route::get('/Get-MyReports-Data/', [MyReports::class, 'getListingData'])->name('get.list.data');

    Route::get('/Switch-User-Profile/{id}', [LoginForm::class, 'switchProfile'])->name('switch.managed.user');

    Route::get('/View-Profile-Ratings/{user_id}', UserRatings::class)->name('View.Profile.Ratings');
    Route::post('/View-Profile-Post-Ratings', [UserRatings::class, 'UserRating'])->name('View.Profile.Post.Ratings');
    Route::post('/Ratings-Replied', [UserRatings::class, 'UserRatingReplied'])->name('Ratings.Replied');

    //    ==================== User Listing Routes ============
    Route::get('/User-Listing', UserListing::class, )->name('User.Listing');
    Route::post('/User-Broker-Carrier-Request', [UserListing::class, 'requestCarrier'])->name('User.Request.Carrier');
    Route::post('/User-Carrier-Broker-Request', [UserListing::class, 'requestBroker'])->name('User.Request.Broker');
    Route::get('/Private-Listing', PrivateListing::class, )->name('Private.Listing');
    Route::get('/Private-Listing/{List_ID}', [AllUsers::class, 'MoveToListing'])->name('Move.to.Listing');

    Route::get('/New-Listing', NewListing::class, )->name('User.New.Listing');
    Route::post('/New-Listing-Submit', [CreateUpdateListing::class, 'AddNewListing'])->name('User.New.Listing.Submit');
    Route::get('/New-Order', NewOrder::class, )->name('New.Order');

    Route::get('/Book-Order', [NewOrder::class, 'BookOrder'])->name('Book.Order');

    Route::get('/Move-Book-Order/{List_ID}/{User_ID}', [NewOrder::class, 'MoveBookOrder'])->name('User.Move.Book.Order');

    Route::get('/Deleted-Quote', DeletedQuote::class, )->name('Deleted.Quote');
    Route::get('/User-Quote/Delete/{List_ID}', [DeletedQuote::class, 'DeleteQuote'])->name('User.Quote.Delete');

    Route::post('/User-Quote/Cancelled', [DeletedQuote::class, 'OrderCancelledQuote'])->name('Order.Cancelled');

    Route::get('/User-Quote/Reasone', [DeletedQuote::class, 'GetCancelledReasone'])->name('Get.Cancelled.Reasone');

    Route::get('/Cancelled-Quote', CancelledQuote::class, )->name('Cancelled.Quote');

    Route::get('/New-Quote', NewQuote::class, )->name('User.New.Quote');
    Route::post('/New-Quote-Submit', [CreateUpdateQuote::class, 'AddNewQuote'])->name('User.New.Quote.Submit');
    Route::get('/All-Orders/{folder}', CustomFolder::class, )->name('Custom.Quote.Folder');

    Route::get('/timeline', TimelineQuote::class)->name('quote.timeline');

    Route::post('/Quote-Status', [OrderStatus::class, 'QuoteStatus'])->name('Order.Status');
    Route::get('/get-quote-status', [OrderStatus::class, 'getQuoteStatus'])->name('Get.Quote.Status');
    Route::get('/redirection', [OrderStatus::class, 'Redirection'])->name('redirection');

    Route::get('/Edit-Quote/{List_ID}', [NewQuote::class, 'EditQuote'])->name('Edit.Quote');
    Route::post('/Edit-Quote-Update', [CreateUpdateQuote::class, 'updateQuote'])->name('User.Quote.Update');

    Route::get('/Show-Quote/{List_ID}', [NewQuote::class, 'ShowQuote'])->name('Show.Quote');

    Route::get('/order-Generate-Invoice/{List_ID}/{User_ID}', [OrderFormController::class, 'GenerateInvoice'])->name('Generate.Invoice');

    Route::get('/order-form-payment', [OrderFormPaymentController::class, 'index']);
    Route::post('/order-form-payment-store', [OrderFormPaymentController::class, 'store'])->name('order.form.payment.store');

    Route::get('/order-form-setting', [OrderFormSettingController::class, 'index'])->name('order.form.setting');
    Route::post('/order-form-store', [OrderFormSettingController::class, 'store'])->name('order_form_settings.store');

    // Task Calendar
    // Route::get('/task/calendar', TaskCalendar::class, 'CalendarTask')->name('task.calendar');
    Route::get('/task-calendar', [TaskCalendarController::class, 'CalendarTask'])->name('task.calendar');
    Route::post('/task-store', [TaskCalendarController::class, 'TaskCalenderStore'])->name('task.calendar.store');

    Route::get('/get-task', [TaskCalendarController::class, 'GetTask'])->name('Get.Task.Data');

    Route::delete('/tasks/{id}', [TaskCalendarController::class, 'destroy'])->name('tasks.destroy');
    // Route::get('/tasks/{id}', [TaskCalendarController::class, 'destroy2'])->name('tasks.destroy2');
    Route::get('/tasks-delete/{id}', [TaskCalendarController::class, 'destroy2'])->name('tasks.destroy2');

    Route::get('/number-of-login', [NumberOfLoginController::class, 'NumberOfLogin'])->name('number.of.login');
    Route::post('/submit-number-of-login', [NumberOfLoginController::class, 'StoreNumberOfLogin'])->name('store.number.of.login');

    // Replicate Listing
    Route::get('/Replicate-Listing/{List_ID}', ReplicateListing::class)->name('User.Replicate.Listing');
    Route::post('/Replicate-Listing-Store', [CreateUpdateListing::class, 'replicateListing'])->name('User.Listing.Replicate');

    Route::get('/Edit-Listing/{List_ID}', EditListing::class)->name('User.Edit.Listing');
    Route::get('/Expire-Listing-Re-Enlisted/{List_ID}', EditListing::class)->name('User.Expire.Re.Edit.Listing');
    Route::post('/Edit-Listing-Update', [CreateUpdateListing::class, 'updateListing'])->name('User.Listing.Update');

    Route::get('/Waiting-Listing', WaitingForApprovals::class, )->name('Waitings.Listing');
    Route::post('/Dispatch-Listing-Post', [WaitingForApprovals::class, 'assignDispatch'])->name('User.Wait.Listing');

    Route::get('/Dispatch-Listing', UserDispatchListing::class, )->name('Dispatch.Listing');
    Route::get('/Dispatch-Listing/{List_ID}/{req_user?}', DispatchListing::class, )->name('User.Dispatch.Listing');
    Route::post('/Waiting-Listing-Post', [DispatchListing::class, 'assignWaitings'])->name('User.Dispatch.Listing.Post');
    Route::post('/Request-Listing-Delete', [DispatchListing::class, 'delete_req'])->name('User.Request.Listing.Delete');

    Route::get('/Direct-Dispatch-Listing', DirectDispatch::class, )->name('User.Direct.Dispatch');
    Route::post('/Direct-Dispatch-Listing-Post', [DirectDispatch::class, 'directDispatchCreate'])->name('User.Direct.Dispatch.Create');

    Route::get('/Pickup-Approval-Listing', PickupApproval::class, )->name('PickUp.Approval.Listing');
    Route::get('/Order-Pickup/{List_ID}', [PickupApproval::class, 'OrderPickup'])->name('Order.Pickup');
    Route::get('/Order-Not-Pickup/{List_ID}', [PickupApproval::class, 'OrderNotPickup'])->name('Order.Not.Pickup');

    Route::get('/Pickup-Listing', PickupListing::class)->name('PickUp.Listing');
    Route::get('/Order-Pickup-Approval/{List_ID}', [PickupListing::class, 'OrderPickupApproval'])->name('Order.Pickup.Approval');
    Route::get('/Order-Not-Pickup-Approval/{List_ID}', [PickupListing::class, 'OrderNotPickupApproval'])->name('Order.Not.Pickup.Approval');

    Route::post('/Attach-BOL-Pickup', [MainController::class, 'AttachBOLPickup'])->name('Attach.BOL.Pickup');

    Route::get('/Deliver-Approval-Listing', DeliverApproval::class, )->name('Deliver.Approval.Listing');
    Route::get('/Order-Deliver-Approval/{List_ID}', [DeliverApproval::class, 'OrderDeliveredApproval'])->name('Order.Deliverd.Approval');
    Route::get('/Order-Not-Delivered-Approval/{List_ID}', [DeliverApproval::class, 'OrderNotDeliveredApproval'])->name('Order.Not.Deliverd.Approval');

    Route::post('/Attach-BOL-Deliver', [MainController::class, 'AttachBOLDeliver'])->name('Attach.BOL.Deliver');

    Route::get('/Delivered-Listing', DeliverdListing::class, )->name('Delivered.Listing');
    Route::get('/Order-Delivered/{List_ID}', [DeliverdListing::class, 'OrderDelivered'])->name('Order.Deliverd');
    Route::get('/Order-Not-Delivered/{List_ID}', [DeliverdListing::class, 'OrderNotDelivered'])->name('Order.Not.Deliverd');

    Route::get('/Completed-Listing', CompletedListing::class, )->name('Completed.Listing');
    Route::get('/Order-Completed/{List_ID}', [CompletedListing::class, 'OrderCompleted'])->name('Order.Completed');
    Route::get('/Order-Not-Completed/{List_ID}', [CompletedListing::class, 'OrderNotCompleted'])->name('Order.Not.Completed');

    Route::get('/Requests-Receive-Listings', RequestedListing::class, )->name('Requested.Listing');
    Route::get('/Requests-Cancel-Listings/{List_ID}', [RequestedListing::class, 'CancelOrderRequest'])->name('Requested.Listing.Canceled');

    Route::get('/Archived-Listing', ArchieveListing::class, )->name('User.Archived.Listing');
    Route::get('/Restore-Listing/{List_ID}', [ArchieveListing::class, 'restoreListing'])->name('User.Listing.Restore');
    Route::get('/Archive-Listing/{List_ID}', [ArchieveListing::class, 'archiveListing'])->name('User.Listing.Archive');

    Route::get('/Expired-Listing', ExpiredListing::class, )->name('User.Expired.Listing');
    Route::get('/Re-List-Expired-Listing/{List_ID}', [ExpiredListing::class, 'ReEnlistListing'])->name('User.ReList.Expired.Listing');

    Route::get('/Cancelled-Listing', CancelledListing::class, )->name('Cancelled.Listing');
    Route::post('/Cancel-Listing', [CancelledListing::class, 'CancelListing'])->name('Listing.Cancel');
    Route::post('/Cancel-Waiting-Request', [CancelledListing::class, 'CancelWaitingRequest'])->name('User.Cancel.Request');

    Route::get('/Deleted-Listing', DeletedListing::class, )->name('Deleted.Listing');
    Route::get('/Deleted-Listing/{List_ID}', [DeletedListing::class, 'restoreDeletedListing'])->name('User.Deleted.Restore');
    Route::get('/Deleted-Listing/Delete/{List_ID}', [DeletedListing::class, 'DeleteListing'])->name('User.Listing.Delete');

    Route::get('/Restore-Quote/{List_ID}', [ArchieveQuote::class, 'restoreQuote'])->name('User.Quote.Restore');

    Route::get('/Order-Agreement/{List_ID}', OrderAgreement::class, )->name('Order.Agreement');
    Route::get('/View-Agreement/{List_ID}', ViewOrderAgreement::class, )->name('View.Agreement');

    Route::get('/Order-Attachments/{List_ID}', ListingGallery::class, )->name('Order.Attachments');

    // =================== Extras Functionality Routes ================
    Route::post('/Add-Miscellaneous', [PickupListing::class, 'AddMiscellaneous'])->name('Order.Misc');
    Route::get('/Listing-Filter-Data', ListingFilter::class, )->name('Filterd.Listing');
    Route::get('/Get-All-Company', [ListingFilter::class, 'getAllCompanies'])->name('Filter.All.Company');

    // Dry Vans
    Route::get('/Calculate-Freight-Class', FrieghtCalculator::class, )->name('Freight.Calculate');

    // Truck Space Routes
    Route::get('/View-All-Truck-Space', AllTruckSpace::class, )->name('View.TruckSpace');
    Route::get('/My-All-Truck', MyAllTrucks::class, )->name('View.MyTrucks');
    Route::get('/View-Google-Truck-Space', GoogleTruckSpace::class, )->name('View.Google.TruckSpace');
    Route::post('/Add-New-Truck-Space', [AllTruckSpace::class, 'addTruckSpace'])->name('Post.TruckSpace');
    Route::post('/Add-New-Heavy-Truck-Space', [AllTruckSpace::class, 'addHeavyTruckSpace'])->name('Post.HeavyTruckSpace');
    Route::post('/Add-New-Truck-Space-Dry', [AllTruckSpace::class, 'addTruckSpaceDry'])->name('Post.TruckSpaceDry');

    // Notification Routes
    Route::get('/View-All-Notification/{user_id}', MyNotifications::class, )->name('View.Notification');
    Route::get('/Delete-Notification/{notify_id}', [MyNotifications::class, 'deleteNotification'])->name('Delete.Notification');
    Route::get('Mark-Read-Notification/{notify_id}', [MyNotifications::class, 'markRead'])->name('Mark.Notification');

    // Invoices
    Route::get('/My-Invoices', PaymentInvoices::class, )->name('View.Invoices');

    Route::get('/LoadBoard-Packages', LoadPackages::class, )->name('View.Packages');
    Route::post('/Subscribe-Packages', [LoadPackages::class, 'SubscribeNow'])->name('Subscribe.Package');

    Route::get('/LogOut', [LoginForm::class, 'UserLogout'])->name('User.LogOut');

    // Watchlist
    Route::get('/My-Watchlist', WishlistListing::class, )->name('User.Watchlist');
    // Route::get('/My-Watchlist', [WishlistListing::class, 'index'])->name('User.Watchlist');

    // Border Wait Time
    Route::get('/border-wait-time', [BorderWaitTime::class, 'index'])->name('borderWaitTime.index');

    // Listing Global Search
    Route::get('/global-search', [GlobalSearchController::class, 'search'])->name('global.search.index');

    // Quote Global Search
    Route::get('/quote-global-search', [GlobalSearchController::class, 'QuoteSearch'])->name('quote.global.search');

});
Route::post('/updateUserStatus', [UserRegistration::class, 'updateUserStatus'])->name('updateUserStatus');

// Misc Charges
Route::get('/get-misc-charges', [MainController::class, 'getMiscCharges'])->name('get.misc.charges');

// View Carrier Request
Route::get('/View-Carrier-Request', [RequestedListing::class, 'viewCarrierRequest'])->name('View.Carrier.Request');

// Watchlist
Route::get('/Add-To-Watchlist/{id}', [WishlistListing::class, 'store'])->name('User.Watchlist.store');

// ============== Support Routes ============
Route::group(['middleware' => 'Authorized', 'prefix' => 'Support'], static function () {
    Route::get('/My-Tickets', ThreeWaySupports::class, )->name('My.Tickets');
    Route::post('/Create-Order-Ticket', [ThreeWaySupports::class, 'CreateOrderTicket'])->name('Create.Tickets');
    Route::get('/Ticket-Details/{Ticket_ID}', TicketDetails::class)->name('Ticket.Details');
    Route::post('/Post-Order-Ticket-Comments', [TicketDetails::class, 'PostComments'])->name('Post.Comments');
    Route::post('/Admin-Ticket-Attachment', [TicketDetails::class, 'TicketAttachment'])->name('Ticket.Attachment');
});

// ============== Dispatched To Me Routes =====================
Route::group(['middleware' => 'Authorized', 'prefix' => 'My-Dispatching'], static function () {
    Route::get('/Time-Quote-Listing', TimeQoute::class, )->name('Time.Qoute');
    Route::get('/My-Waiting-For-Approval', WaitingForMyApproval::class, )->name('My.Waiting.Approval');
    Route::get('/Requested-To-Me', MyRequested::class, )->name('My.Requested');
    Route::get('/Dispatched-To-Me', DispatchedToMe::class, )->name('My.Dispatched');
    Route::get('/My-Pickup-Approval', MyPickupApproval::class, )->name('My.Pickup.Approval');
    Route::get('/My-Pickups', MyPickup::class, )->name('My.Pickups');
    Route::get('/My-Deliver-Approval', MyDeliverApproval::class, )->name('My.Deliver.Approval');
    Route::get('/My-Delivers', MyDeliver::class, )->name('My.Delivers');
    Route::get('/My-Completed', MyCompleted::class, )->name('My.Completed');
    Route::get('/My-Cancelled', MyCancelled::class, )->name('My.Cancelled');
    Route::get('/Misc-Approve', ApproveMisc::class, )->name('My.Misc.Approve');
    Route::get('/Update-Misc-Status/{List_ID}/{Status}', [ApproveMisc::class, 'updateMiscStatus'])->name('Update.Misc.Status');
});

// ==================== Global Routes =============
Route::get('/View-Profile/{user_id}', ViewProfile::class)->name('View.Profile');
Route::get('/Profile-Network-Post/{CMP_Find}/{CMP_ID}', [ViewProfile::class, 'addMyNetwork'])->name('Profile.Add.Network');
Route::get('/Profile-Blocked-Post/{CMP_Find}/{CMP_ID}', [ViewProfile::class, 'blockedMyNetwork'])->name('Profile.Blocked.Network');
Route::get('/Profile-Network-Update/{CMP_Find}/{CMP_ID}', [ViewProfile::class, 'updateMyNetwork'])->name('Profile.Update.Network');
Route::post('search-for-loads', [SearchLoadsController::class, 'searchForLoads'])->name('search.for.loads');

// ================ AJAX Searching Routes ==============
Route::get('autocomplete-city_state', [DayDispatchServices::class, 'getCityState'])->name('get.city.state');
Route::get('autocomplete-search', [DayDispatchServices::class, 'getZipCodeLocation'])->name('autocomplete');
Route::get('company-search', [MainController::class, 'findNetwork'])->name('Find.Network');
Route::get('Company-Searching-From-SearchBar', [MainController::class, 'searchCompanyName'])->name('Find.Company');
Route::get('Company-Get-Info', [MainController::class, 'getDispatchCompanyName'])->name('Get.Dispatch.Company');
Route::get('Get-All-Carrier-Request', [MainController::class, 'getAllCarrierRequest'])->name('Get.All.Carrier.Request');
Route::get('Get-All-Comparison-Listing', [MainController::class, 'getAllComparisonListing'])->name('Get.All.Comparison.Listing');
Route::get('Get-All-Previous-Listing', [MainController::class, 'getAllPreviousListing'])->name('Get.All.Previous.Listing');
Route::get('Get-Vin-Number', [MainController::class, 'getVinNumber'])->name('Get.Vin.Number');
Route::get('Get-Make', [MainController::class, 'getVehcileMake'])->name('Get.Vehcile.Make');
Route::get('Get-Model', [MainController::class, 'getVehcilModel'])->name('Get.Vehcile.Model');
Route::get('Get-Notification', [MainController::class, 'getNotification'])->name('Get.Notification');
Route::get('Get-Message', [MainController::class, 'GetMessage'])->name('Get.Message');
Route::get('Get-Admin-Notification', [MainController::class, 'getAdminNotification'])->name('Get.Admin.Notification');
Route::get('Search-Order-ID', [MainController::class, 'SearchOrderID'])->name('Search.Order.ID');
Route::get('Get-Counts', [MainController::class, 'getOrderCounts'])->name('Get.Order.Counts');
Route::get('Get-Quote-Counts', [MainController::class, 'getQuoteCounts'])->name('Get.Quote.Counts');

Route::get('Get-All-Lane-Carriers', [UserListing::class, 'getAllLaneCarrier'])->name('Get.All.Lane.Carriers');


// ==================== Filtered Routes =============
Route::get('Get-Origin-Location', [ListingFilter::class, 'getOriginLocation'])->name('Get.Origin.Location');
Route::get('Get-Filtered-Data', [ListingFilter::class, 'getFilteredData'])->name('Get.Filtered.Records');

// save filter form data
Route::post('Save-Filtered-Data', [ListingFilter::class, 'SaveFilteredRecords'])->name('Save.Filtered.Records');
Route::get('Get-Filter-Data', [ListingFilter::class, 'GetFilterData'])->name('Get.Filter.Data');
Route::get('Delete-Filtered-Data/{id}', [ListingFilter::class, 'DeleteFilteredRecords'])->name('delete.filter.record');
Route::get('Single-Filtered-Data/{id}', [ListingFilter::class, 'SingleFilteredRecord'])->name('single.filter.record');

Route::get('Get-state', [ListingFilter::class, 'getState'])->name('Get.state');
Route::get('Get-city', [ListingFilter::class, 'getCity'])->name('Get.city');
Route::get('Get-Zipcode', [ListingFilter::class, 'getZipcode'])->name('Get.Zipcode');

Route::get('/Testing', [TestingController::class, 'index'])->name('Code.Testing');

// Route::post('/email_order/{id}/{userid}', [OrderFormController::class, 'sendLinkEmail'])->name('send.link.email');
Route::post('/email_order/{id}/{userid}', [OrderFormController::class, 'sendLinkEmail'])->name('send.link.email');

Route::get('/order-form/{List_ID}/{User_ID}', [OrderFormController::class, 'index'])->name('order.form');
Route::post('/store-order-form', [OrderFormController::class, 'store'])->name('order.form.store');

Route::get('/order-form-submitted/{List_ID}/{User_ID}', [OrderFormController::class, 'OrderFormSubmitted'])->name('order.form.submitted');

Route::get('/order-MoveTo-Loardboard/{List_ID}/{User_ID}', [OrderFormController::class, 'MoveToLoardboard'])->name('MoveTo.Loardboard');

// notify carrier
Route::post('/Notify-Company/{Order_ID}', [MainController::class, 'notifyCompany'])->name('Notify.Company');

// remind carrier
Route::get('/remind-company', [MainController::class, 'remindCompany'])->name('remind.with.email');

// get quote order history
Route::get('/Get-Order-History', [OrderHistoryController::class, 'index'])->name('Get.Order.History');

Route::post('/Customer-Feedback', [CustomerFeedback::class, 'index'])->name('Customer.Feedback');

Route::post('/fetch-listings', [UserListing::class, 'fetchListings'])->name('fetch.listings');
Route::post('/fetch-listings-dates', [UserListing::class, 'fetchListingsDates'])->name('fetch.listings.dates');

// Bulk Selection
Route::post('/bulk-action', [UserListing::class, 'bulkAction'])->name('bulk.action');
Route::post('/bulk-action-quote', [NewOrder::class, 'bulkActionQuote'])->name('bulk.action.quote');

// ============ Breeze Default Route
//Route::get('dashboard', function (){
//    return view('dashboard');
//})->middleware(['Authorized'])->name('dashboard');

require __DIR__ . '/auth.php';
