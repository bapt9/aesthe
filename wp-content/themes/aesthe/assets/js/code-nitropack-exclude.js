import { tns } from 'tiny-slider/src/tiny-slider';

window.addEventListener("DOMContentLoaded", function() {
	// SLIDES BEFORE AFTER OFFRES / TECHNIQUES
	if(document.querySelector('.avantApres')){
		var divisorAvantApres = document.querySelector(".avantApres__image__after"),
			sliderAvantApres = document.getElementById("avantApres__range");
			sliderAvantApres.addEventListener('input', event => {
			divisorAvantApres.style.width = sliderAvantApres.value+"%";

		})
	}

	// SLIDES BEFORE AFTER BLOC TECHNINIQUE V1
    if(document.querySelector('.beforeAfter')){
    
    var divisor = document.querySelector(".beforeAfter__image__after"),
    slider = document.getElementById("beforeAfter__range");
            
    slider.addEventListener('input', event => {
        divisor.style.width = slider.value+"%";
    })
}

    // OFFER CARDS NEW VERSION
    if(document.querySelector('.cardNew')){

        let cards = document.querySelectorAll(".cardNew");        

        cards.forEach(card => {
            if (window.screen.width < 800) {
                card.onclick = function () {

                    //disable buton
                    // card.children[1].children[1].children[1].classList.toggle('disabled');

                    //resize card
                    card.classList.toggle("show");

                    //slides up
                    card.children[0].classList.toggle("show");
                    card.children[1].classList.toggle("show");

                    //circle right
                    card.firstElementChild.lastElementChild.classList.toggle("show");

                    //show content
                    card.lastElementChild.lastElementChild.classList.toggle("show");

                }
        }

            if (window.screen.width > 1000) {
                card.onmouseover = function() {
                // resize card
                card.classList.add("show");

                //slides up
                card.children[0].classList.add("show");
                card.children[1].classList.add("show");

                //circle right
                card.firstElementChild.lastElementChild.classList.add("show");

                //show content
                card.lastElementChild.lastElementChild.classList.add("show");
            }

            card.onmouseout = function() {
                //resize card
                card.classList.remove("show");

                //slides up
                card.children[0].classList.remove("show");
                card.children[1].classList.remove("show");

                //circle right
                card.firstElementChild.lastElementChild.classList.remove("show");

                //show content
                card.lastElementChild.lastElementChild.classList.remove("show");
            }
        }
        });

}
    // SLIDER OFFER CARDS
    if(document.querySelector('.sliderCardsSlider')){
        var sliderCards = [];
        document.querySelectorAll('.sliderCardsSlider').forEach((item, i)=>{
        sliderCards[i] = tns({
            container: item.querySelector('.sliderCards'),
            slideBy: "page",
            controlsPosition : "bottom",
            nav: false,
            loop: false,
            controls: true,
            controlsContainer : item.querySelector(".sliderCards__controls"),
            preventScrollOnTouch: "auto",
            mouseDrag: true,
            nav: false,
            responsive: {
                	0: {
                        items: 1,
                        edgePadding: 30,

					},
                    800: {
                        items : 4,
                        edgePadding: 0,
                        // fixedWidth: 350
                        },
				},
        });
        });

        // grise les slides inactifs
          if (window.innerWidth < 1000) {

          const array =Array.from(sliderCards.getInfo().slideItems)
          for (let i = 1; i < array.length; i++) {
              const e = array[i];
              e.classList.add('greyfilter');
          }
          sliderCards.events.on('indexChanged', () => {
            const info = sliderCards.getInfo();
            const indexPrev = info.indexCached;
            const indexCurr = info.index;
            info.slideItems[indexPrev].classList.add('greyfilter');
            info.slideItems[indexCurr].classList.remove('greyfilter');
          });
    }
    }

    // TARIFF CARDS
    if (document.querySelector('.tarifsCards')) {

        let tarifcards = document.querySelectorAll(".tarifsCard");

        let i = 1;
        tarifcards.forEach(tcard => {
            
            tcard.onclick = function () {
                
                tarifcards.forEach(e => {
                    if (tcard != e) {
                        e.children[1].classList.remove("on");
                        }
                });

                tcard.children[1].classList.toggle("on");
                tcard.classList.remove("on");

                
            }
            
            let prevcard = tarifcards[i - 1];
            console.log(prevcard.offsetHeight);

            if (window.screen.width > 1000) {
                tcard.onmouseover = function () {
                    if (tcard.lastElementChild.classList.contains('on') === false) {
                        tcard.classList.add("on");
                    }
                }

                tcard.onmouseout = function () {
                    tcard.classList.remove("on");
                }
            };

            i++;
        })

                // var viewportOffset = tcard.getBoundingClientRect();
                // var previousNode = tcard.previousSibling.previousSibling;
                // var top = viewportOffset.top
                // console.log(previousNode.offsetHeight);
                // console.log(top);
                // // window.scrollTo(0, 0);
                // // tcard.offsetHeight = previousNode;
    }



    if(document.querySelector('.glsr')){
        let reviewsEl = document.querySelector('#give-reviews')
        if(reviewsEl){
            reviewsEl.addEventListener('click', event => {
            let form = document.querySelector('form.customised-review-form')
            let separator = document.querySelector('.glsr-form-wrap-separator');
            
            form.classList.toggle('on');

            if (form.classList.contains('on')) {
			form.style.maxHeight = form.scrollHeight + 90 +'px'
			form.style.paddingTop = '30px'
            form.style.paddingBottom = '30px'
            separator.style.width = '77%';
            } else if (!(form.classList.contains('on'))) {
            form.style.maxHeight = '0px'
			form.style.paddingTop = '0px'
            form.style.paddingBottom = '0px'
            separator.style.width = '0%';
            }

		})}
	}
});

// SLIDER AVIS
//     if (document.querySelector('.customised-reviews-wrap')) {
//     const sliderAvis = tns({
//         container: '.customised-reviews',
//         slideBy: "page",
//         // autoplay : "true",
//         loop: false,
//         preventScrollOnTouch: "auto",
//         mouseDrag: true,
//         autoHeight: true,
//         nav: false,
//         // navPosition: "bottom",
//         controls: true,
//         controlsContainer: ".customised-reviews-wrap__controls",
//         responsive: {
//                 0: {
//                     items: 1,
//                     gutter: 30,
//                 },
//                 800: {
//                     items: 2,
//                     gutter: 30,
//                 },
//                 1000: {
//                     items : 2,
//                     gutter: 60,
//                 },
//             },
//     });
// }

    // SLIDER BADGES
if (document.querySelector('.sliderBadgesGallery')) {

    const sliderBadges = tns({
        container: '.sliderBadgesGallery',
        slideBy: 1,
        autoplay: true,
        speed: 700,
        loop: true,
        nav: false,
        controls: false,
        preventScrollOnTouch: "auto",
        // touch: false,
        mouseDrag: false,
        controls: false,
                    responsive: {
                0: {
                    items: 2,
                    gutter: 20,
                },
                1000: {
                    items: 5,
                    gutter: 100,
                    // fixedWidth: 100
                    },
            },
    });

}