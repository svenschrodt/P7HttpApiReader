/**
 * main.js -  functions for DOM manipulation
 *
 * @package P7HttpApiReader
 * @version 0.1
 * @since 2020-07-26
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
"use strict";

/**
 * Adding two input fields for entering name-value pair of HTTP parameters
 * 
 */
function addNameValueInput() {

    // Define attributes for first input element [name of parameter]
	var att = {
		"name": "paramName[]",  
		"type":  "text",  
		"size": "12",  
		"class": "gui"  
	}
	// Getting refrence to parent element, where inputs will be appended
	var myList = document.getElementById("parameterList");
	
	// Appending input filed for parmeter name
	myList.appendChild(getElement("input", att));

	// Appending input field for parmeter value
	
	 // Changing name attribute for second input element [value of parameter]
	att["name"] = "paramValue[]";
	myList.appendChild(getElement("input", att));
	myList.appendChild(document.createElement("br"));

}



/***
 * Creating new HTML element with given attributes and optional content
 * 
 * @returns {HTMLElement}
 */

function getElement(name, attributes, content) {
	// Checking if 3rd parameter is given
	var content = content || null;
	
	// Creating new HTML element
	var node = document.createElement(name);
	
	// Adding attributes to HE
	for(var attName in attributes) {
		node.setAttribute(attName, attributes[attName]);
	}
		  
    // if content given, add it to node
	if (content != null) { 
		// @todo switch by type of content -assuming it is text
		node.appendChild(document.createTextNode(content));
	} 
	
	return node;
} 