angular.module('pollingSite.controllers',[])

.controller ('welcomeCtrl', function ($scope,$state,Users){
   $scope.user={};
   $scope.login= function() {
   
       Users.login($scope.user)
       .success(function(data){
       if (data=="User not found!") {
       console.log(data);
       	$state.reload();
       } else if (data.result=="User found!"){
       console.log(data);
        $scope.loggedinUser = data;
        localStorage.setItem('loggedinUser', JSON.stringify($scope.loggedinUser));
      
        $state.go('pollingpage');
       }
       
       })
       .error(function(err){
       console.log(err);
          
       });
};
})

.controller ('pollingpageCtrl', function ($scope){

})

.controller ('cvcpollingCtrl', function ($scope, Users){
$scope.loggedinUser=JSON.parse(localStorage.getItem('loggedinUser'));
$scope.choice = {};

Users.getUsers() 
.success (function(data){
	$scope.members = data;
	$scope.sec3s = [];
	$scope.sec2s = [];
	for (i=0;i<$scope.members.length;i++){
	    if ($scope.members[i].level=="SEC3") {
	        $scope.sec3s.push($scope.members[i]);
	    } else if ($scope.members[i].level=="SEC2") {
	        $scope.sec2s.push($scope.members[i]);
	}
	}
	console.log($scope.members);

})
.error (function(err){
	console.log(err);
})

$scope.submit_cvc = function(){
      Users.submitchoice($scope.loggedinUser, $scope.choice)
      .success(function(data){
      
      	console.log(data);
      })
      .error(function(err){
      	console.log(err);
      })
}
})

.controller ('tlpollingCtrl', function ($scope, Users){
Users.getUsers() 
.success (function(data){
	$scope.members = data;
	
	console.log($scope.members);

})
.error (function(err){
	console.log(err);
})
})

.controller ('endpollingCtrl', function ($scope){

});