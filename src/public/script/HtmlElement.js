/**
 * HtmlElement.js - extending HEs with methods for DOM operations mostly as
 * fluent interfaces, if possible (not for getters returning non objects;-))
 *
 * @package P7HttpApiReader
 * @version 0.1
 * @since 2020-08-05
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @copyright Sven Schrodt<sven@schrodt-service.net>
"use strict";

/**
 * Setting display property to 'none'
 *
 * @returns {HTMLElement}
 */
HTMLElement.prototype.hide = function() {
	this.style.display = 'none';
	return this;
}

/**
 * Setting display property to 'inline' || 'block'
 *
 * @returns {HTMLElement}
 */
HTMLElement.prototype.show = function() {
	this.style.display = (this.isInline()) ? 'inline' : 'block';
	return this;
}

/**
 * Adding class to an element
 *
 * @returns {HTMLElement}  || {String}
 */
HTMLElement.prototype.addClass = function(className) {
	var classNames = this.className.split(' ');
	if (classNames.indexOf(className) != -1) {
		return this;
	} else {
		classNames.push(className);
		this.className = classNames.join(' ');
	}
	return this;
}

/**
 * Checking if an element has given class
 *
 * @returns boolean
 */
HTMLElement.prototype.hasClass = function(className) {
	var classNames = this.className.split(' ');
	return (classNames.indexOf(className) == -1) ? false : true;
}

/**
 * Removing class from an element
 *
 * @returns {HTMLElement} || {String}
 */
HTMLElement.prototype.removeClass = function(className) {
	var classNames = this.className.split(' ');
	var pos = classNames.indexOf(className);
	if (pos == -1) { // class name not found
		return this;
	} else { // class name found -> remove from array
		classNames.splice(pos, 1);
		this.className = classNames.join(' ');
	}
	return this;
}

/**
 * Getting full name of element
 *
 * @returns {String}
 */
HTMLElement.prototype.getName = function() {
	var parts = this.toString().split(' ');
	return parts[1].replace(']', '');
}

/**
 * Getting short name of element
 *
 * @returns {String}
 */
HTMLElement.prototype.getShortName = function() {
	return this.tagName.toLowerCase();
}

/**
 * Checking if element is an inline element
 *
 * @returns {String}
 */
HTMLElement.prototype.isInline = function() {
	var inlineElements = [ 'b', 'big', 'i', 'small', 'tt', 'abbr', 'acronym',
			'cite', 'code', 'dfn', 'em', 'kbd', 'strong', 'samp', 'var', 'a',
			'bdo', 'br', 'img', 'map', 'object', 'q', 'script', 'span', 'sub',
			'sup', 'button', 'input', 'label', 'select', 'textarea' ];
	return (inlineElements.indexOf(this.getShortName()) == -1) ? false : true;
}

/**
 * Register callback function for onclick event
 *
 * @param callbackFunction
 * @returns {HTMLElement}
 */
HTMLElement.prototype.click = function(callbackFunction) {
	// alert(callbackFunction);
	this.onclick = callbackFunction;
	return this;
}

/**
 * Register callback funciton for onchange event
 *
 * @param callbackFunction
 * @returns {HTMLElement}
 */
HTMLSelectElement.prototype.change = function(callbackFunction) {
	// alert(callbackFunction);
	this.onchange = callbackFunction;
	return this;
}

/**
 * Getting || Setting *value* of selected element
 *
 * @param callbackFunction
 * @returns {HTMLElement} || string
 */
HTMLSelectElement.prototype.val = function(value) {
	var i; // counter variable
	value = value || null;
	if (value == null) { // as Getter
		return this.options[this.selectedIndex].value;
	} else { // as Setter
		for (i = 0; i < this.options.length; i++) {
			if (this.options[i].value == value) {
				this.selectedIndex = i;
				continue;
			}
		}
	}
}


/**
 *  Getting || Setting text content for text area form elments
 *
 *  @param value
 *  @return {HTMLElement}
 *
 */
HTMLTextAreaElement.prototype.val = function(value) {
	value = value || null;
	if (value == null) { // as Getter
		return this.textContent;
	} else { // as Setter
		this.textContent = value;
		return this;
	}
}

/**
 * Getting || Setting text node child of element
 *
 * @param value
 * @returns {HTMLElement}
 */
HTMLElement.prototype.text = function(content) {
	content = content || null;
	if (content != null) {
		this.textContent = content;
		return this;
	} else {
		return this.textContent;
	}
	return this;
}

/**
 * Toggle between classes classA, classB
 *
 * @param {String} classA
 * @param {String} classB
 * @returns {HTMLElement}
 */
HTMLElement.prototype.toggleClass = function(classA, classB) {
	if (this.hasClass(classA)) {
		this.removeClass(classA);
		this.addClass(classB);
	} else {
		this.removeClass(classB);
		this.addClass(classA);
	}
	return this;
}

/**
 * Getting || Setting inner HTML content of an element
 *
 * @param {String} content
 * @returns string || {HTMLElement}
 */
HTMLElement.prototype.html = function(content) {
	content = content || null;
	if (content != null) {
		this.innerHTML = content;
		return this;
	} else {
		return this.innerHTML;
	}
}

// form elements
/**
 * Getting || Setting text value of an input element
 *
 * @param {String} content
 * @returns string || {HTMLElement}
 */
HTMLInputElement.prototype.val = function(content) {
	content = content || null;
	if (content != null) {
		this.value = content;
		return this;
	} else {
		return this.value;
	}
	return this;
}

/**
 * Register callback function for onchange event for input elements
 *
 * @param function callbackFunction
 * @returns {HTMLElement}
 */
HTMLInputElement.prototype.change = function(callbackFunction) {
	this.oninput = callbackFunction;
	return this;
}

/**
 * Getting || Setting text value of an output element
 *
 * @param {String} content
 * @returns {HTMLElement}
 */
HTMLOutputElement.prototype.val = function(content) {
	content = content || null;
	if (content != null) {
		this.value = content;
		return this;
	} else {
		return this.value;
	}
	return this;
}

/**
 * Toggle status of checked property
 *
 * @returns {HTMLElement}
 */
HTMLInputElement.prototype.toggleChecked = function() {
	this.checked = (this.checked) ? false : true;
	return this;
}

/**
 * Iterate over node list and invoke callback function for each element of list
 *
 *
 * @param function callbackFunction
 */
NodeList.prototype.each = function(callbackFunction) {
	Array.prototype.forEach.call(this, callbackFunction);
}

/**
 * Iterate over html collection and invoke callback function for each element of list
 *
 * @param function callbackFunction
 */
HTMLCollection.prototype.each = function(callbackFunction) {
	Array.prototype.forEach.call(this, callbackFunction);
}