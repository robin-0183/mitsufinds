<style>
.stars-bg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}
.stars-bg .stars-bg-clickable {
    position: absolute;
    inset: 0;
    pointer-events: none;
}
.stars-bg .star-dot {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    pointer-events: auto;
    cursor: pointer;
    transition: transform 0.1s ease-out, opacity 0.1s ease-out, background 0.1s ease-out;
    will-change: opacity;
    animation: stars-bg-twinkle var(--twinkle-duration, 3s) ease-in-out infinite;
}
.stars-bg .star-dot:hover {
    transform: scale(1.5);
    background: rgba(255, 255, 255, 1);
}
.stars-bg .star-dot.star-pop {
    transform: scale(2.4);
    opacity: 0;
    transition: transform 0.12s ease-out, opacity 0.12s ease-out;
}
@keyframes stars-bg-twinkle {
    0% {
        opacity: 0.45;
    }
    40% {
        opacity: 0.8;
    }
    60% {
        opacity: 0.95;
    }
    100% {
        opacity: 0.55;
    }
}
</style>
<div class="stars-bg" id="stars-bg" aria-hidden="true">
    <div class="stars-bg-clickable" id="stars-clickable"></div>
</div>
<script>
(function () {
    var container = document.getElementById('stars-clickable');
    if (!container) return;

    function randomBetween(min, max) {
        return min + Math.random() * (max - min);
    }

    function createStar() {
        var star = document.createElement('span');
        star.className = 'star-dot';
        star.setAttribute('role', 'button');
        star.setAttribute('aria-label', 'Star');
        star.style.left = randomBetween(1, 99) + '%';
        star.style.top = randomBetween(1, 99) + '%';
        star.style.opacity = randomBetween(0.5, 1).toFixed(2);
        star.style.setProperty('--twinkle-duration', randomBetween(2.4, 4.2).toFixed(1) + 's');
        star.style.animationDelay = randomBetween(0, 4).toFixed(2) + 's';

        star.addEventListener('click', function (e) {
            e.stopPropagation();
            if (star.classList.contains('star-pop')) return;
            star.classList.add('star-pop');
            setTimeout(function () {
                star.remove();
                var newStar = createStar();
                container.appendChild(newStar);
            }, 120);
        });

        return star;
    }

    for (var i = 0; i < 220; i++) {
        container.appendChild(createStar());
    }
})();
</script>
