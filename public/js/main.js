/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/***/ (() => {

eval("var loginForm = document.getElementById('login_Form');\nvar registerForm = document.getElementById('register_Form');\ndocument.getElementById('register_Trigger').addEventListener('click', function () {\n  loginForm.classList.add('d-none');\n  registerForm.classList.remove('d-none');\n});\ndocument.getElementById('login_Trigger').addEventListener('click', function () {\n  loginForm.classList.remove('d-none');\n  registerForm.classList.add('d-none');\n});\n$(function () {\n  $('login_Form').on('submit', function (e) {\n    e.preventDefault();\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbWFpbi5qcz9mZGFjIl0sIm5hbWVzIjpbImxvZ2luRm9ybSIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJyZWdpc3RlckZvcm0iLCJhZGRFdmVudExpc3RlbmVyIiwiY2xhc3NMaXN0IiwiYWRkIiwicmVtb3ZlIiwiJCIsIm9uIiwiZSIsInByZXZlbnREZWZhdWx0Il0sIm1hcHBpbmdzIjoiQUFDQSxJQUFJQSxTQUFTLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixZQUF4QixDQUFoQjtBQUNBLElBQUlDLFlBQVksR0FBR0YsUUFBUSxDQUFDQyxjQUFULENBQXdCLGVBQXhCLENBQW5CO0FBRUFELFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixrQkFBeEIsRUFBNENFLGdCQUE1QyxDQUE2RCxPQUE3RCxFQUFzRSxZQUFVO0FBQzVFSixFQUFBQSxTQUFTLENBQUNLLFNBQVYsQ0FBb0JDLEdBQXBCLENBQXdCLFFBQXhCO0FBQ0FILEVBQUFBLFlBQVksQ0FBQ0UsU0FBYixDQUF1QkUsTUFBdkIsQ0FBOEIsUUFBOUI7QUFDSCxDQUhEO0FBS0FOLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixlQUF4QixFQUF5Q0UsZ0JBQXpDLENBQTBELE9BQTFELEVBQW1FLFlBQVU7QUFDekVKLEVBQUFBLFNBQVMsQ0FBQ0ssU0FBVixDQUFvQkUsTUFBcEIsQ0FBMkIsUUFBM0I7QUFDQUosRUFBQUEsWUFBWSxDQUFDRSxTQUFiLENBQXVCQyxHQUF2QixDQUEyQixRQUEzQjtBQUNILENBSEQ7QUFPQUUsQ0FBQyxDQUFDLFlBQVU7QUFDUkEsRUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQkMsRUFBaEIsQ0FBbUIsUUFBbkIsRUFBNkIsVUFBU0MsQ0FBVCxFQUFXO0FBQ3BDQSxJQUFBQSxDQUFDLENBQUNDLGNBQUY7QUFDSCxHQUZEO0FBR0gsQ0FKQSxDQUFEIiwic291cmNlc0NvbnRlbnQiOlsiXHJcbnZhciBsb2dpbkZvcm0gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9naW5fRm9ybScpO1xyXG52YXIgcmVnaXN0ZXJGb3JtID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3JlZ2lzdGVyX0Zvcm0nKTtcclxuXHJcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdyZWdpc3Rlcl9UcmlnZ2VyJykuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgbG9naW5Gb3JtLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG4gICAgcmVnaXN0ZXJGb3JtLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG59KTtcclxuXHJcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdsb2dpbl9UcmlnZ2VyJykuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgbG9naW5Gb3JtLmNsYXNzTGlzdC5yZW1vdmUoJ2Qtbm9uZScpO1xyXG4gICAgcmVnaXN0ZXJGb3JtLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xyXG59KTtcclxuXHJcblxyXG5cclxuJChmdW5jdGlvbigpe1xyXG4gICAgJCgnbG9naW5fRm9ybScpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICB9KTtcclxufSk7Il0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9tYWluLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/main.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/main.js"]();
/******/ 	
/******/ })()
;