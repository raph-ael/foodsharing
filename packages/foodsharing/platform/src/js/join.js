var join = {
	currentStep:0,
	googleApiKey:null,
	markerIcon:null,
	marker:null,
	isLoading:false,
	init: function( googleApiKey )
	{
		this.googleApiKey = googleApiKey;
	},
	photoUploadError: function(error){
		pulseError(error);
		join.isLoading = false;
		$('#joinform .avatar form').removeClass('load');
		$('#join_avatar_error').val('1');
	},
	readyUpload: function(name){
		$('#joinform .avatar .container').html('').css({
			'background-image':'url(/tmp/' + name + ')'
		});
		join.isLoading = false;
		$('#joinform .avatar form').removeClass('load');
		$('#join_avatar').val(name);
	},
	startUpload: function()
	{
		$('#join_photoform').addClass('load').submit();
		join.isLoading=true;
		$('#joinform .avatar .container').css('background-image','none').html('<span class="mega-octicon octicon-device-camera"></span><span class="fa fa-circle-o-notch fa-spin"></span>');
	},
	loadMap: function()
	{
		$.getScript( "https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=" + this.googleApiKey, function() {
			var addressPicker = new AddressPicker({
				map: {
					id: 'join_mapview'
				},
				autocompleteService: {
					types: ["geocode", "establishment"]
				},
				placeDetails: true
			});

			$('#login_location').typeahead(null, {
				displayKey: 'description',
				source: addressPicker.ttAdapter()
			});
			$('#login_location').bind('typeahead:selected', addressPicker.updateMap)
			$('#login_location').bind('typeahead:cursorchanged', addressPicker.updateMap)
			addressPicker.bindDefaultTypeaheadEvent($('#login_location'))
			$(addressPicker).on('addresspicker:selected', function (event, result) {
				var number = result.nameForType('street_number') || ''
				var address = result.nameForType('route') || ''
				$('#join_lat').val(result.lat());
				$('#join_lon').val(result.lng());
				$('#join_plz').val(result.nameForType('postal_code'));
				$('#join_ort').val(result.nameForType('locality'));
				$('#join_str').val(address);
				$('#join_hsnr').val(number);
				$('#join_country').val(result.nameForType('country'));
			});
		})
	},
	finish: function(){
		
		if($('#join_legal1:checked').length <= 0)
		{
			pulseError('Bitte akzeptiere unsere Datenschutzerkl&auml;rung');
			return false;
		}
		else if($('#join_legal2:checked').length <= 0)
		{
			pulseError('Bitte akzeptiere unsere Rechtsvereinbarung');
			return false;
		}
		else
		{
			$('#joinform').hide();
			$('#joinloader').show();
			
			$.ajax({
				url: '/xhrapp/?app=login&m=joinsubmit',
				type:'post',
				dataType:'json',
				data:{
					iam:$('#join_iam').val(),
					name:$('#login_name').val(),
					surname:$('#login_surname').val(),
					email:$('#login_email').val(),
					pw:$('#login_passwd1').val(),
					avatar:$('#join_avatar').val(),
					phone:$('#login_phone').val(),
					lat:$('#join_lat').val(),
					lon:$('#join_lon').val(),
					str:$('#join_str').val(),
					nr:$('#join_hsnr').val(),
					plz:$('#join_plz').val(),
					city:$('#join_ort').val(),
					gender:$('#login_gender').val(),
					country:$('#join_country').val(),
					newsletter:$('#newsletter').val()
				},
				success: function(ret){
					if(ret.status != undefined && ret.status == 1)
					{
						$('#joinloader').hide();
						$('#joinready').show();
					}
					else if(ret.status != undefined && ret.status == 0)
					{
						pulseError(ret.error);
						$('#joinloader').hide();
						$('#joinform').show();
						join.step(1);
					}
				}
			});
			
		}
	},
	step: function(step)
	{
		
		if(join.currentStep >= step || join.stepCheck(step))
		{
			switch(step)
			{
				case 2:
					join.loadMap();
					break;
					
				default:
					break;
			}
			
			$('.step').hide();
			$('.step'+step).show();
			$('.linklist.join li').removeClass('active').children('a').children('i').remove();
			$('.linklist.join li.step'+step).addClass('active');
			$('.linklist.join li.step'+step).removeClass('hidden').children('a').append('<i class="fa fa-hand-o-right"></i>');
			join.currentStep = step;
		}
	},
	stepCheck: function(step){

		switch(join.currentStep)
		{
			case 1:
				check = true;
				
				if($('#login_name').val() == '')
				{
					pulseInfo('Bitte Gib einen Benutzernamen ein');
					$('#login_name').select();
					return false;
					check = false;
				}
				
				if(!checkEmail($('#login_email').val()))
				{
					pulseError('Mit Deiner E-Mail Adresse stimmt etwas nicht');
					$('#login_email').select();
					return false;
					check = false;
				}
				
				if($('#login_passwd1').val().length < 4) // || $('#login_passwd1').val() != $('#login_passwd2').val())
				{
					pulseInfo('Dein Passwort muss länger als 4 Buchstaben sein');
					$('#login_passwd1').select();
					return false;
					check = false;
				}
				
				if($('#login_passwd1').val() != $('#login_passwd2').val())
				{
					pulseInfo('Deine Passwörter stimmen nicht überein');
					$('#login_passwd1').select();
					return false;
					check = false;
				}
				
				if(join.isLoading)
				{
					pulseInfo('Bitte warte bis Dein Foto hochgeladen ist');
					return false;
					check = false;
				}
				
				if($('#join_avatar_error').val() == '0' && $('#join_avatar').val() == '')
				{
					if(!confirm('Du hast kein Foto hochgeladen. Beachte, dass ein passbildähnliches Foto benötigt wird, wenn du später auch als Foodsaver aktiv werden möchtest. Ohne Foto fortfahren?'))
					{
						return false;
						check = false;
					}
				}
				
				if(check)
				{
					return true;
				}
				else
				{
					return false;
				}
				
				break;
				
			default:
				return true;
				break;
		}
	}
};
