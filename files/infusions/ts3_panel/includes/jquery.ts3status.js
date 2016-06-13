/**
 * jQuery Teamspeak 3 Status
 *
 * Displays a simple server status widget utilizing the "Simple REST API"
 * from Planet Teamspeak (https://www.planetteamspeak.com).
 *
 * @author Christian Hanne <support@aureola.codes>
 * @license MIT
 */
(function($) {
  'use strict';

  /**
   * Creates a new Ts3Status instance.
   *
   * @param {HTMLelement} element
   *   Widget's html element.
   * @param {object} options
   *   Widget options object.
   */
  var Ts3Status = function Ts3Status(element, options) {
    this.element = $(element);
    this.options = $.extend({}, defaults, options);
    this.request();
  };

  /**
   * [request description]
   * @return {[type]} [description]
   */
  Ts3Status.prototype.request = function request() {
    this.element.addClass('ts3-updating');
    $.ajax({
      url: this.getUrl(),
      type: 'GET',
      success: this.response.bind(this),
      error: this.error.bind(this)
    });
  };

  /**
   * Handles assorted request errors.
   *
   * @param  {object} request
   *   jQuery request object.
   */
  Ts3Status.prototype.error = function error(request) {
    this.response({
      status: 'error',
      result: {
        'code': request.status,
        'message': request.statusText
      }
    });
  };

  /**
   * Handles any request response from the simple rest api.
   *
   * @param  {object} response
   *   Response object as defined by the simple rest api.
   */
  Ts3Status.prototype.response = function response(response) {
    this.element.removeClass('ts3-updating');
    this.element.addClass('ts3-' + response.status);

    if (response.status === 'success') {
      this.render(null, response.result);
      this.options.onError.call(this.element.get(0), response);
    }
    else {
      this.render(response.result);
      this.options.onSuccess.call(this.element.get(0), response);
    }

    if (this.options.rate > 0) {
      setTimeout(this.request.bind(this), this.options.rate);
    }
  };

  /**
   * Renders the request's results.
   *
   * @param {object|null} error
   *   Contains an error object. Will be null on success.
   * @param {object|null} result
   *   Contains a result object. Will be null on error.
   */
  Ts3Status.prototype.render = function render(error, result) {
    var output;
    if (error) {
      output = this.options.templateError
        .replace('{{error}}', error.message);
    }
    else {
      output = this.options.templateSuccess
        .replace('{{server}}', result.name)
        .replace('{{country}}', result.country)
        .replace('{{users}}', result.users)
        .replace('{{slots}}', result.slots)
        .replace('{{url}}', this.getConnectUrl());
    }

    this.element.html(output);
  };

  /**
   * Returns the server's rest api url.
   *
   * @return {String}
   *   Simple rest api url.
   */
  Ts3Status.prototype.getUrl = function getUrl() {
    return this.options.api + '/' + this.options.host + '/' + this.options.port;
  };

  /**
   * Returns an url for a ts3 connect link.
   *
   * @return {String}
   *   Ts3 connect url.
   */
  Ts3Status.prototype.getConnectUrl = function getConnectUrl() {
    return 'ts3server://' + this.options.host + '/?port=' + this.options.port;
  };

  var defaults = {
    api: 'https://api.planetteamspeak.com/serverstatus',
    host: 'localhost',
    port: '80',
    rate: 10000,
    onSuccess: function() {},
    onError: function() {},
    templateError: '<div class="ts3-error">{{error}}</div>',
    templateSuccess: '<div class="ts3-name">{{server}}({{country}})</div><div class="ts3-slots">Slots: {{users}}/{{slots}}</div><a href="{{url}}">Connect</a>'
  };

  $.fn.ts3status = function ts3status(options) {
    options = options || {};
    return this.each(function _init() {
      new Ts3Status(this, options);
    });
  };

  $.fn.ts3status.defaults = defaults;
})(jQuery);
