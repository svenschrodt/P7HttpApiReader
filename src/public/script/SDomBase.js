/**
 * SDomBase.js - API for simpler access to DOM of an HTML5 document
 *
 * @package P7HttpApiReader
 * @version 0.1
 * @since 2020-08-05
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
"use strict";

var SDom = SDom || new Object;

SDom.Base = {

    // Generic DOM query function for [CSS] selectors
	bySelector : function(selector) {
		return document.querySelectorAll(selector);
	},
    // Getter for refernce to element with certain ID
	byId: function (id) {
		return document.getElementById(id);
	}
}

