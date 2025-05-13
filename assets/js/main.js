document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.querySelector('.navbar');

  window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
});

// scripts.js

document.getElementById('nuevaCategoriaCheck').addEventListener('change', function () {
  const nuevaCategoriaDiv = document.getElementById('nuevaCategoriaDiv');
  if (this.checked) {
      nuevaCategoriaDiv.style.display = 'block';
      document.getElementById('categoria_id').disabled = true;
  } else {
      nuevaCategoriaDiv.style.display = 'none';
      document.getElementById('categoria_id').disabled = false;
  }
});

