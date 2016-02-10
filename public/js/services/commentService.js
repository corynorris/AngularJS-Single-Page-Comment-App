var commentService = angular.module('commentService', ['ngResource']);

commentService.factory('Comment', ['$resource',
  function($resource){
  	'use strict';

    return $resource('api/comments/:commentId');

  }]);