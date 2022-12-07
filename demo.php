<?php
if(false): 
    ?>
<style>
body,html{
    overflow-x:hidden!important;
}
     .particle {
	--x: 0;
	--y: 0;
	background-color: rebeccapurple;
	border-radius: 50%;
	position: absolute;
	top: 50%;
	left: 50%;
	height: 5px;
	width: 5px;
	z-index: 999999999999999999999999;
}

.particle.move {
	animation: move 1000ms linear forwards;
}

@keyframes move {
	to {
		transform: translate(var(--x), var(--y));
	}
	
	95% {
		opacity: 1;
	}
	
	100% {
		opacity: 0;
	}
}
</style>
<script>
        setInterval(function () {$('body').trigger('click')}, 2000);
        setInterval(function () {$('html').trigger('click')}, 2500);
        $(document).on('click', 'body,html',function(e) {
        	const particles = [];
        	const color = randomColor();
        	const btn = this;
        	
        	const particle = document.createElement('span');
        	particle.classList.add('particle', 'move');
        	
        	const { x, y } = randomLocation();
        	particle.style.setProperty('--x', x);
        	particle.style.setProperty('--y', y);
        	particle.style.background = color;
        // 	btn.style.background = color;
        	
        	btn.appendChild(particle);
        	
        	particles.push(particle);
        	
        	setTimeout(() => {
        	
        		for(let i=0; i<100; i++) {
        			const innerP = document.createElement('span');
        			innerP.classList.add('particle', 'move');
        			innerP.style.transform = `translate(${x}, ${y})`;
        
        			const xs = Math.random() * 200 - 100 + 'px';
        			const ys = Math.random() * 200 - 100 + 'px';
        			innerP.style.setProperty('--x', `calc(${x} + ${xs})`);
        			innerP.style.setProperty('--y', `calc(${y} + ${ys})`);
        			innerP.style.animationDuration = Math.random() * 300 + 200 + 'ms';
        			innerP.style.background = color;
        			
        			btn.appendChild(innerP);
        			particles.push(innerP)
        		}
        		
        		setTimeout(() => {
        			particles.forEach(particle => {
        				particle.remove();
        			})
        		}, 1000)
        	}, 1000);
        });
        
        function randomLocation() {
        	return {
        		x: Math.random() * window.innerWidth - window.innerWidth / 2 + 'px',
        		y: Math.random() * window.innerHeight - window.innerHeight / 2 + 'px',
        	}
        }
         
        function randomColor() {
        	return `hsl(${Math.floor(Math.random() * 361)}, 100%, 50%)`;
        }
       
    </script>
    
    <?php
endif;
?>