const holder = document.querySelector('.full-size-thumbnail__holder');
const image = document.querySelector('.full-size-thumbnail__image');
console.log(holder, image);
if (holder !== undefined) {
  window.addEventListener('scroll', function() {
    requestAnimationFrame(parallax);
  });

  function parallax() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    image.style.transform = `translateY(${-50 + scrollTop / 7}%) scale(${(100 + scrollTop / 25) /
      100})`;
  }
}
