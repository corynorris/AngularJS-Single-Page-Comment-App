var commentController = angular.module('commentController', []);

commentController.controller('commentCtrl', ['$scope','Comment', function($scope, Comment){
	'use strict';

	var comments = $scope.comments = Comment.query();

	$scope.orderProp = '-created_at';
	$scope.loading = false;

	function resetComment() {
		$scope.newComment ={
			text: '',
			author: ''
		}
	}
	resetComment();

	$scope.submitComment = function() {

		if ($scope.newComment.text === "" || $scope.newComment.author ==="")
			return;

		Comment.save($scope.newComment, function(response) {
			//assign the new created_at and id
			$scope.newComment.id = response.id;
			$scope.newComment.created_at = response.created_at;
			
			// save add the comment to the page
			$scope.comments.push($scope.newComment);
			resetComment();
		});
	}

	$scope.deleteComment = function(commentToDelete) {

		var idx = $scope.comments.indexOf(commentToDelete);

		Comment.delete({commentId: commentToDelete.id }, function() {
			$scope.comments.splice(idx,1);
		});		
	}

}]);