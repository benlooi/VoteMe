angular.module ('services',[])
.factory ('Users', function($http){
	var factory = {};
	
	factory.login = function(user){
	return $http.post('apis/index.php/users/login', {user:user});
	}
	
	factory.getUsers = function(){
		return $http.get('apis/index.php/users/getusers');

	}
	
	factory.submitchoice = function(user, choice){
		return $http.post('apis/index.php/users/submitchoice', {user:user, choice:choice});
	}
	return factory;
}); 