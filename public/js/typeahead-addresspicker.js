(function() {
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  (function($) {
    this.AddressPickerResult = (function() {
      function AddressPickerResult(placeResult, fromReverseGeocoding) {
        this.placeResult = placeResult;
        this.fromReverseGeocoding = fromReverseGeocoding != null ? fromReverseGeocoding : false;
        this.latitude = this.placeResult.geometry.location.lat();
        this.longitude = this.placeResult.geometry.location.lng();
      }

      AddressPickerResult.prototype.addressTypes = function() {
        var component, type, types, _i, _j, _len, _len1, _ref, _ref1;
        types = [];
        _ref = this.addressComponents();
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          component = _ref[_i];
          _ref1 = component.types;
          for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
            type = _ref1[_j];
            if (types.indexOf(type) === -1) {
              types.push(type);
            }
          }
        }
        return types;
      };

      AddressPickerResult.prototype.addressComponents = function() {
        return this.placeResult.address_components || [];
      };

      AddressPickerResult.prototype.address = function() {
        return this.placeResult.formatted_address;
      };

      AddressPickerResult.prototype.nameForType = function(type, shortName) {
        var component, _i, _len, _ref;
        if (shortName == null) {
          shortName = false;
        }
        _ref = this.addressComponents();
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          component = _ref[_i];
          if (component.types.indexOf(type) !== -1) {
            return (shortName ? component.short_name : component.long_name);
          }
        }
        return null;
      };

      AddressPickerResult.prototype.lat = function() {
        return this.latitude;
      };

      AddressPickerResult.prototype.lng = function() {
        return this.longitude;
      };

      AddressPickerResult.prototype.setLatLng = function(latitude, longitude) {
        this.latitude = latitude;
        this.longitude = longitude;
      };

      AddressPickerResult.prototype.isAccurate = function() {
        return !this.placeResult.geometry.viewport;
      };

      AddressPickerResult.prototype.isReverseGeocoding = function() {
        return this.fromReverseGeocoding;
      };

      return AddressPickerResult;

    })();
    return this.AddressPicker = (function(_super) {
      __extends(AddressPicker, _super);

      function AddressPicker(options) {
        if (options == null) {
          options = {};
        }
        this.markerDragged = __bind(this.markerDragged, this);
        this.updateBoundsForPlace = __bind(this.updateBoundsForPlace, this);
        this.updateMap = __bind(this.updateMap, this);
        this.options = $.extend({
          local: [],
          datumTokenizer: function(d) {
            return Bloodhound.tokenizers.whitespace(d.num);
          },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          autocompleteService: {
            types: ["geocode"]
          },
          zoomForLocation: 16,
          reverseGeocoding: false,
          placeDetails: true
        }, options);
        AddressPicker.__super__.constructor.call(this, this.options);
        if (this.options.map) {
          this.initMap();
        }
        this.placeService = new google.maps.places.PlacesService(document.createElement('div'));
      }

      AddressPicker.prototype.bindDefaultTypeaheadEvent = function(typeahead) {
        typeahead.bind("typeahead:selected", this.updateMap);
        return typeahead.bind("typeahead:cursorchanged", this.updateMap);
      };

      AddressPicker.prototype.initMap = function() {
        var _ref, _ref1;
		this.mapOptions = $.extend({
			zoom: 3,
			center: L.latLng(0, 0),
			boundsForLocation: this.updateBoundsForPlace,
		  }, this.options.map);
		  if(this.mapOptions.map) {
		  	this.map = this.mapOptions.map
		  }
		  else {
			  this.map = L.map(this.mapOptions.id, this.mapOptions);
			  L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}", {
				  attribution: "Geocoding by <a href=\"https://google.com\">Google</a>, Tiles &copy; Esri 2014"
			  }).addTo(this.map);
		  }

        this.lastResult = null;
        var fsIcon = L.AwesomeMarkers.icon({
			  icon: "smile",
			  markerColor: "orange",
			  prefix: "img"
		});
        this.marker = L.marker(this.mapOptions.center, {icon: fsIcon}).addTo(this.map);
      };

      AddressPicker.prototype.get = function(query, cb) {
        var service;
        service = new google.maps.places.AutocompleteService();
        this.options.autocompleteService.input = query;
        return service.getPlacePredictions(this.options.autocompleteService, (function(_this) {
          return function(predictions) {
            $(_this).trigger('addresspicker:predictions', [predictions]);
            return cb(predictions);
          };
        })(this));
      };

      AddressPicker.prototype.updateMap = function(event, place) {
        if (this.options.placeDetails) {
          return this.placeService.getDetails(place, (function(_this) {
            return function(response) {
              var _ref;
              _this.lastResult = new AddressPickerResult(response);
              if (_this.marker) {
                _this.marker.setLatLng(L.latLng(response.geometry.location.lat(), response.geometry.location.lng()));
              }
              if (_this.map) {
                if ((_ref = _this.mapOptions) != null) {
                  _ref.boundsForLocation(response);
                }
              }
              return $(_this).trigger('addresspicker:selected', _this.lastResult);
            };
          })(this));
        } else {
          return $(this).trigger('addresspicker:selected', place);
        }
      };

      AddressPicker.prototype.updateBoundsForPlace = function(response) {
        if (response.geometry.viewport) {
          return this.map.fitBounds(L.latLngBounds(L.latLng(response.geometry.viewport.getNorthEast().lat(), response.geometry.viewport.getNorthEast().lng()),
			  L.latLng(response.geometry.viewport.getSouthWest().lat(), response.geometry.viewport.getSouthWest().lng())));
        } else {
          this.map.setCenter(L.latLng(response.geometry.location.lat(), response.geometry.location.lng()));
          return this.map.setZoom(this.options.zoomForLocation);
        }
      };

      AddressPicker.prototype.markerDragged = function() {
        if (this.options.reverseGeocoding) {
          return this.reverseGeocode(this.marker.getPosition());
        } else {
          if (this.lastResult) {
            this.lastResult.setLatLng(this.marker.getPosition().lat(), this.marker.getPosition().lng());
          } else {
            this.lastResult = new AddressPickerResult({
              geometry: {
                location: this.marker.getPosition()
              }
            });
          }
          return $(this).trigger('addresspicker:selected', this.lastResult);
        }
      };

      AddressPicker.prototype.reverseGeocode = function(position) {
        if (this.geocoder == null) {
          this.geocoder = new google.maps.Geocoder();
        }
        return this.geocoder.geocode({
          location: position
        }, (function(_this) {
          return function(results) {
            if (results && results.length > 0) {
              _this.lastResult = new AddressPickerResult(results[0], true);
              return $(_this).trigger('addresspicker:selected', _this.lastResult);
            }
          };
        })(this));
      };

      AddressPicker.prototype.getGMap = function() {
        return this.map;
      };

      AddressPicker.prototype.getGMarker = function() {
        return this.marker;
      };

      return AddressPicker;

    })(Bloodhound);
  })(jQuery);

}).call(this);
