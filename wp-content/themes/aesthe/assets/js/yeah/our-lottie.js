// import gsap from 'gsap';
// import lottie from "lottie-web";


export default class OurLottie {	

	static init() {
		/*
		if(!this.pageTransition) {
			this.pageTransition = lottie.loadAnimation({
				container: document.querySelector('.page__lottie'),
				renderer: 'svg',
				loop: false,
				autoplay: false,
				path: home_url+'/wp-content/themes/dce/assets/lottie/0-page.json'
			})
			this.pageTransition.addEventListener('DOMLoaded', () => {
				document.querySelector('.pink').classList.add('off') // only si intro video
				document.querySelector('.page__lottie svg').setAttribute('preserveAspectRatio', 'none')
			});
		}

		// if(document.querySelector('body.home')) this.homeBoard()
		*/
		
	}

	static page() {
		// this.pageTransition.goToAndPlay(0,0)
	}

	static homeBoard() {
		/*
		const homeBoardLottie = lottie.loadAnimation({
			container: document.querySelector('.homeBoard__lottie'),
			renderer: 'svg',
			loop: false,
			autoplay: true,
			path: home_url+'/wp-content/themes/dce/assets/lottie/2-TraitsRose.json'
		});

		homeBoardLottie.addEventListener('DOMLoaded', () => {
			gsap.ticker.add(function ok() {
				if(!document.querySelector('.homeBoard')) gsap.ticker.remove(ok)
				else if(document.querySelector('.homeBoard').getBoundingClientRect().top<window.innerHeight/2) {
					homeBoardLottie.goToAndPlay(0,0)
					gsap.ticker.remove(ok);
				}

			});
		})
		*/
	}
	
}









