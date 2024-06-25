import { tns } from 'tiny-slider/src/tiny-slider';

// fixed scrollbar
if(window.innerWidth>1024 && !is_touch_device() && document.querySelector('body').scrollWidth>document.querySelector('body').offsetWidth) document.querySelector('html').classList.add('widthFixedScrollbar');

window.addEventListener("DOMContentLoaded", function () {

	//add margin top for the schroll with the summary
	if (document.querySelector('a[href^="#"]')) {

		let links = document.querySelectorAll('a[href^="#"]');
		links.forEach(function (i) {
			i.addEventListener("click", function () {
				let id = (i["hash"]).slice(1);
				let anchor = document.getElementById(id);
				anchor.classList.add('anchor');
			})
		});
	};
	//
	if(document.querySelector('body[local]')) document.addEventListener('keypress', logKey);

	if(document.querySelector('.announcementBar')) {
		document.querySelector('.announcementBar div:first-of-type').classList.add('on')
		if(document.querySelectorAll('.announcementBar div').length>1) {
			setInterval(function() {
				var nextAnnouncement = indexInParent(document.querySelector('.announcementBar div.on')) + 1
				if(nextAnnouncement>=document.querySelectorAll('.announcementBar div').length) nextAnnouncement = 0
				document.querySelector('.announcementBar div.on').classList.remove('on')
				document.querySelectorAll('.announcementBar div')[nextAnnouncement].classList.add('on')
			}, 4000)
		}
	}

		// ONGLETS DEROULANT FAQ
		Array.prototype.forEach.call(document.querySelectorAll('.faqBlock li'), function(el, i){
			el.addEventListener('click', function() {
				if(el.classList.contains('on')) el.classList.remove('on')
				else {
					if(document.querySelector('.faqBlock li.on')) document.querySelector('.faqBlock li.on').classList.remove('on')
					el.classList.add('on')
				}
			})
		})

		// ONGLETS DEROULANT QUESTIONS H2 DETAILS BLOC
		Array.prototype.forEach.call(document.querySelectorAll('.detailsOffreBlock li'), function(el, i){
			el.addEventListener('click', function() {
				if(el.classList.contains('on')) el.classList.remove('on')
				else {
					if(document.querySelector('.detailsOffreBlock li.on')) document.querySelector('.detailsOffreBlock li.on').classList.remove('on')
					el.classList.add('on')
				}
			})
		})

		// ONGLET ZONE
		if(document.querySelector('.zoneBlock__content')){
			var zonesSlideTech = tns({ controls:false, container: document.querySelector('.zoneBlock__content'), mode: "gallery", speed: 800 });
			console.log(zonesSlideTech);
	
			zonesSlideTech.events.on('indexChanged', ()=>{
				let index = zonesSlideTech.getInfo().index
				let slides = document.querySelectorAll('.zoneBlock__controls li')
				document.querySelector('.zoneBlock__controls li.active').classList.remove('active')
				slides[index%slides.length].classList.add('active')
			});
	
			document.querySelectorAll('.zoneBlock__controls li').forEach((item, index) => {
				item.addEventListener('click', event => {
					if(!item.classList.contains('active')){
						zonesSlideTech.goTo(index)
					}
				})
			})
	
			document.querySelectorAll('.zoneBlock__single__traces').forEach(item =>{
				item.addEventListener("mousedown", function (e) {
					let bounds = this.getBoundingClientRect();
					let left = (e.clientX - bounds.left)/bounds.width * 100;
					let top = (e.clientY - bounds.top)/bounds.height * 100;
	
					console.log(top.toFixed(2) +"%", left.toFixed(2) +"%");
				});
			})
		}	

		// ONGLET DECLINAISON SOINS
		if(document.querySelector('.topOffre__content')){
			var zonesSlide = tns({ controls:false, container: document.querySelector('.topOffre__content'), mode: "gallery", speed: 800 });
	
			zonesSlide.events.on('indexChanged', ()=>{
				let index = zonesSlide.getInfo().index
				let slides = document.querySelectorAll('.topOffre__controls li')
				let buttons = document.querySelectorAll('.topOffre__single__button')
				document.querySelector('.topOffre__controls li.active').classList.remove('active')
				
				slides[index%slides.length].classList.add('active')

				document.querySelector('.topOffre__single__button.on').classList.remove('on')
				buttons[index%buttons.length].classList.add('on')

			});
	
			document.querySelectorAll('.topOffre__controls li').forEach((item, index) => {
				item.addEventListener('click', event => {
					if(!item.classList.contains('active')){
						zonesSlide.goTo(index)
					}
				})
			})
		}

			// ONGLET DECLINAISON SOINS V2
	if (document.querySelector('.offreBlock')) {
			var zonesSlideV2 = tns({ controls:false, container: document.querySelector('.offreBlock__content'), mode: "gallery", speed: 800 });
	
			zonesSlideV2.events.on('indexChanged', ()=>{
				let index = zonesSlideV2.getInfo().index
				let slides = document.querySelectorAll('.offreBlock__controls li')
				let buttons = document.querySelectorAll('.offreBlock__single__button')
				document.querySelector('.offreBlock__controls li.active').classList.remove('active')
				
				slides[index%slides.length].classList.add('active')

				document.querySelector('.offreBlock__single__button.on').classList.remove('on')
				buttons[index%buttons.length].classList.add('on')

			});
	
			document.querySelectorAll('.offreBlock__controls li').forEach((item, index) => {
				item.addEventListener('click', event => {
					if(!item.classList.contains('active')){
						zonesSlideV2.goTo(index)
					}
				})
			})
		}
	
		Array.prototype.forEach.call(document.querySelectorAll('.offreProduits__advices button'), function(el, i){
		el.addEventListener('click', function() {
			if(el.classList.contains('open')) el.classList.remove('open')
			else {
				if(document.querySelector('.offreProduits__advices button.open')) document.querySelector('.offreProduits__advices button.open').classList.remove('open')
				el.classList.add('open')
			}
		})
	})

	var slider = []
		Array.prototype.forEach.call(document.querySelectorAll('.testiBlock__slider'), function(el, i){
			slider[i] = tns({ mode:'gallery', controls:false, dots:true, navPosition: 'bottom', container: el, mouseDrag: true, loop: false, preventScrollOnTouch: "auto" });
	})

	if(document.querySelector('.discountBlock__slide')){
		Array.prototype.forEach.call(document.querySelectorAll('.discountBlock__slide'), function(el, i){
			tns({ controls:false, dots:true, autoplay: true, autoplayButtonContainer:false, navPosition: 'bottom', container: el, mouseDrag: true, loop: true, preventScrollOnTouch: "auto" });
		})
	}


	if(document.querySelector('.hugeNumbers')){
		var hugeNumbers = tns({responsive: { 601:{disable:true} }, controls:false, dots:true, autoplay: true, autoplayButtonContainer:false, navPosition: 'bottom', container: document.querySelector('.hugeNumbers'), mouseDrag: true, loop: false, preventScrollOnTouch: "auto" });
	}


	if(document.querySelector('.simpleTabs__content')){
		var simpleTabs = tns({ controls:false, container: document.querySelector('.simpleTabs__content'), mode: "gallery", speed: 800 });

		simpleTabs.events.on('indexChanged', ()=>{
			let index = simpleTabs.getInfo().index
			let slides = document.querySelectorAll('.simpleTabs__controls__single')
			document.querySelector('.simpleTabs__controls__single.active').classList.remove('active')
			slides[index%slides.length].classList.add('active')
		});

		document.querySelectorAll('.simpleTabs__controls__single').forEach((item, index) => {
			item.addEventListener('click', event => {
				if(!item.classList.contains('active')){
					simpleTabs.goTo(index)
					document.querySelector('.simpleTabs__controls__single.active').classList.remove('active')
					item.classList.add('active')
				}
			})
		})
	}


	if(document.querySelector('.twoTabs__content')){
		var twoTabs = tns({ controls:false, container: document.querySelector('.twoTabs__content'), mode: "gallery", speed: 800 });

		twoTabs.events.on('indexChanged', ()=>{
			let index = twoTabs.getInfo().index
			let slides = document.querySelectorAll('.twoTabs__controls__single')
			document.querySelector('.twoTabs__controls__single.active').classList.remove('active')
			slides[index%slides.length].classList.add('active')
		});

		document.querySelectorAll('.twoTabs__controls__single').forEach((item, index) => {
			item.addEventListener('click', event => {
				if(!item.classList.contains('active')){
					twoTabs.goTo(index)
				}
			})
		})
	}


	if(document.querySelector('.offres__content')){
		var offres = tns({
			controls:false,
			nav:false,
			container: document.querySelector('.offres__content'),
			// mode: "gallery",
			speed: 600,
			items: 1.2,
			gutter: 20,
			preventScrollOnTouch: "auto",
			responsive: {
				400: {
					items: 1.5,
				},
				601: {
					speed: 0,
					items: 1,
					gutter: 0,
				},
			}
		});
		offres.events.on('indexChanged', ()=>{
			let index = offres.getInfo().index - 2
			let slides = document.querySelectorAll('.offres__controls li')
			console.log(index, slides.length)
			document.querySelector('.offres__controls li.active').classList.remove('active')
			slides[index%slides.length].classList.add('active')
		});

		document.querySelectorAll('.offres__controls li').forEach((item, index) => {
			item.addEventListener('click', event => {
				if(!item.classList.contains('active')){
					offres.goTo(index)
				}
			})
		})
	}

// SLIDER ANCIENNE CARTE LISTE
	if(document.querySelector('.techMedsBlock.is-slideshow')){
		var techMeds = []
		document.querySelectorAll('.techMedsBlock.is-slideshow').forEach((item, i)=>{
			techMeds[i] = tns({
				container: item.querySelector('.techMedsSlideshow'),
				controlsContainer: item.querySelector(".controls-container"),
				loop: false,
				nav: false,
				preventScrollOnTouch: "auto",
				gutter: 20,
				mouseDrag: true,
				responsive: {
					1000: {
						gutter: 40,
						fixedWidth: 280,
					},
					600: {
						gutter: 30,
						fixedWidth: 280,
					},
					0: {
						gutter: 20,
						fixedWidth: 260,
					}
				},
				onInit: ()=>{
					console.log('init '+i)
				}});

		})
	}

	// Doctor block : ajout de classe sur le bloc parent colonnes

	if(document.querySelector('.doctorBlock')){
		var docBlock = document.querySelector('.doctorBlock');
		var docBlockParent = docBlock.closest('.wp-block-columns');

		docBlockParent.classList.add('doctorBlock__parent');
	}


	// MENU

	// images subnav
	if(window.innerWidth>1000) {
		var imagesSubNav = document.querySelector('.siteHeader').dataset.img.split(',')
		Array.prototype.forEach.call(document.querySelectorAll('.sub-menu'), function(el, i){
			el.innerHTML = el.innerHTML + '<img src="'+imagesSubNav[i]+'">'
		})
	}

	
	document.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
		item.addEventListener('click', event => {
			if(window.innerWidth <= 1000){
				if(document.querySelector('.menu-item-has-children.open') && !item.classList.contains('open')){
					document.querySelector('.menu-item-has-children.open').classList.remove('open')
					setTimeout(()=>{
						item.classList.toggle('open')
					}, 600)
				} else item.classList.toggle('open')
			}
		})
	})
	

	const burger = document.querySelector('.burger')
	const items = document.querySelector('.menu-menu-principal-francais-container')

	burger.addEventListener('click', (e)=>{
		if(burger.classList.contains('open')){
			burger.classList.remove('open')
			burger.classList.add('close')
			items.classList.remove('open')
			items.classList.add('close')
		}else if(burger.classList.contains('close')){
			burger.classList.add('open')
			burger.classList.remove('close')
			items.classList.remove('close')
			items.classList.add('open')
		}else{
			burger.classList.add('open')
			items.classList.add('open')
		}
		document.querySelector('.siteHeader__nav__container').classList.toggle('open')
		document.querySelector('.menu-item-has-children.open')? document.querySelector('.menu-item-has-children.open').classList.remove('open'): false ;
	})

	window.addEventListener('click', function(e){
		if (!document.querySelector('.siteHeader').contains(e.target) && document.querySelector('.siteHeader__nav__container').classList.contains('open') ){
			document.querySelector('.siteHeader__nav__container').classList.toggle('open')
			if (document.querySelector('.menu-item-has-children.open')) document.querySelector('.menu-item-has-children.open').classList.remove('open')
			document.querySelector('.burger').classList.remove('open')
			document.querySelector('.burger').classList.add('close')
		}
	})

	if(document.querySelector('.submenuSiblings')){
		const buttonRight = document.getElementById('slideRight');
		const buttonLeft = document.getElementById('slideLeft');

		let interval;

		if(buttonLeft){
			buttonLeft.addEventListener('mousedown', ()=>{
				interval = setInterval(()=>{
					document.querySelector('.siblings').scrollLeft -= 10
				}, 25);
			});
			buttonLeft.addEventListener('mouseup', ()=>{
				clearInterval(interval)
			});

			buttonRight.addEventListener('mousedown', ()=>{
				interval = setInterval(()=>{
					document.querySelector('.siblings').scrollLeft += 10
				}, 25);
			});
			buttonRight.addEventListener('mouseup', ()=>{
				clearInterval(interval)
			});
			if(document.querySelector('.siblings').offsetWidth < document.querySelector('.siblings ul').offsetWidth){
				document.querySelector('.submenuSiblings').classList.remove('larger')
			}

			window.addEventListener("resize",debounce(function(e){
				document.querySelector('.submenuSiblings').classList.remove('larger')
				if(document.querySelector('.siblings').offsetWidth > document.querySelector('.siblings ul').offsetWidth){
					document.querySelector('.submenuSiblings').classList.add('larger')
				}
			}));
		}
	}



	if(document.querySelector('.retailMapBlock__item')) {
		let latsLongs = []
		document.querySelectorAll('.retailMapBlock__item').forEach((item, i)=>{
			latsLongs[i] = [item.dataset.latitude, item.dataset.longitude]
		})

		var map = L.map("map", {
			scrollWheelZoom: !1,
			// zoomSnap: 0.5
		});
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicGFtc3R1ZGlvIiwiYSI6ImNrNGd2ZDBkMzAyODgzb3FrM2Zma2JzZWUifQ.illJq3H4A9PMxjQLJfXqRg', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: 'mapbox/streets-v11'
			// zoomOffset: -1,
		}).addTo(map);

		var wpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href

		var homeurl = wpJsonUrl.replace('/wp-json/','');

		var t = L.icon({
			iconUrl: homeurl + "/wp-content/themes/aesthe/assets/img/marker.svg",
			iconSize: [32, 40],
			shadowSize: [0, 0],
			iconAnchor: [16, 40],
			shadowAnchor: [0, 0],
			popupAnchor: [0, 0]
		});
		latsLongs.forEach(position =>{
			L.marker([position[0], position[1]], {
				icon: t
			}).addTo(map);
		})

		var bounds = new L.LatLngBounds(latsLongs);

		map.fitBounds(bounds, {
			padding: [50,50],
			maxZoom: 13,
		});
	}




});


function debounce(func){
	var timer;
	return function(event){
		if(timer) clearTimeout(timer);
		timer = setTimeout(func,100,event);
	};
}




function logKey(e) {
	if(e.code=='Space') {
		e.preventDefault();
		if(document.querySelector('body').classList.contains('dev')) document.querySelector('body').classList.remove('dev');
		else document.querySelector('body').classList.add('dev');
	}
}



function indexInParent(node) {
    var children = node.parentNode.childNodes;
    var num = 0;
    for (var i=0; i<children.length; i++) {
         if (children[i]==node) return num;
         if (children[i].nodeType==1) num++;
    }
    return -1;
}

function is_touch_device() {
	return (('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
}