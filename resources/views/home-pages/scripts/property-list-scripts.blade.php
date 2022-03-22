<script src="{{PUBLIC_ASSETS}}js/angular.js"></script>
<script src="{{PUBLIC_ASSETS}}js/ngStorage.js"></script>
<script src="{{PUBLIC_ASSETS}}js/angular-messages.js"></script>

<script >
  var app = angular.module('academia', ['ngMessages']);
</script>
@include('home-pages.common.angular-factory',array('load_module'=> FALSE))

<script>
	app.controller('prepareProperties', function( $scope, $http, httpPreConfig) {
		$scope.propertyItems = [];
		$scope.total_items = 0;

		$scope.initAngData = function(data) {
			if( data === undefined ) {
            	return;
        	}
        	
	        dta = data;
	        $scope.propertyItems = dta.contents;
	        $scope.setItem('saved_series', $scope.propertyItems);
	        $scope.setItem('total_items', $scope.total_items);
		}

		/**
         * Set item to local storage with the sent key and value
         * @param {[type]} $key   [localstorage key]
         * @param {[type]} $value [value]
         */
        $scope.setItem = function($key, $value){
            localStorage.setItem($key, JSON.stringify($value));
        }

        /**
         * Get item from local storage with the specified key
         * @param  {[type]} $key [localstorage key]
         * @return {[type]}      [description]
         */
        $scope.getItem = function($key){
            return JSON.parse(localStorage.getItem($key));
        }
	});
</script>
