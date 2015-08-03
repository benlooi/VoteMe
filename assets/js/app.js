angular.module('pollingSite',['pollingSite.controllers','services','ui.router'])

.config(function($httpProvider) {
    //Enable cross domain calls
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
})
.config(function($stateProvider,$urlRouterProvider){

	$stateProvider
	.state('welcome', {
		url:"/welcome",
		templateUrl:"templates/welcome.html",
		controller: "welcomeCtrl"
 
	})
        
        .state('pollingpage', {
		url:"/pollingpage",
		templateUrl:"templates/pollingpage.html",
		controller: "pollingpageCtrl"
 
	})

	.state('cVcPolling', {
		url:"/cvcpolling",
		templateUrl:"templates/cvcpolling.html",
		controller: "cvcpollingCtrl"
	})
	
	.state('tlPolling', {
		url:"/tlpolling",
		templateUrl:"templates/tlpolling.html",
		controller: "tlpollingCtrl"
	})
	
	.state('endpolling', {
		url:"/endpolling",
		templateUrl:"templates/endpolling.html",
		controller: "endpollingCtrl"
	});
	
$urlRouterProvider.otherwise('/welcome');
});