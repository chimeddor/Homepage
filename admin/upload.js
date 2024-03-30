'use strict';
var app = angular.module('demo', [
  'ngFileUpload',
  'as.sortable',
  'ngAnimate'
])

.controller('demoController', ['Upload',
  function(Upload) {
    var vm = this;
    vm.documents = [];

    vm.documentDragListeners = {
      accept: function(sourceItemHandleScope, destSortableScope) {
        return sourceItemHandleScope.itemScope.sortableScope.$id === destSortableScope.$id;
      },
      orderChanged: function(event) {}
    };

    vm.fileDragListeners = {
      accept: function(sourceItemHandleScope, destSortableScope) {
        return sourceItemHandleScope.itemScope.sortableScope.$id === destSortableScope.$id;
      },
      orderChanged: function(event) {

      }
    };

    vm.addDoc = function() {
      vm.documents.push({
        type: 'Doc'+vm.documents.length+1,
        files: []
      });
    };
    
    vm.addDoc();
    vm.addDoc();

    vm.addFiles = function(files, arr) {
      files.forEach(function(file) {
        arr.push(file);
      });

    };

    vm.removeDoc = function(idx) {
      vm.documents.splice(idx, 1);
    };

    vm.removeFile = function(arr, idx) {
      arr.splice(idx, 1);
    };
  }
]);