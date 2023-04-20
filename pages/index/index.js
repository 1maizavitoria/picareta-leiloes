var carouselEl = document.querySelector('#myCarousel');
var items = carouselEl.querySelectorAll('.carousel-inner .item');
var indicators = carouselEl.querySelectorAll('.carousel-indicators li');
var prevBtn = carouselEl.querySelector('.carousel-control.left');
var nextBtn = carouselEl.querySelector('.carousel-control.right');
var currentIndex = 0;

function showItem(index) {
  // Remove a classe "active" de todos os itens e indicadores
  for (var i = 0; i < items.length; i++) {
    items[i].classList.remove('active');
    indicators[i].classList.remove('active');
  }
  
  // Adiciona a classe "active" ao item e indicador atual
  items[index].classList.add('active');
  indicators[index].classList.add('active');
  currentIndex = index;
}

function showNext() {
  if (currentIndex < items.length - 1) {
    showItem(currentIndex + 1);
  } else {
    showItem(0);
  }
}

function showPrev() {
  if (currentIndex > 0) {
    showItem(currentIndex - 1);
  } else {
    showItem(items.length - 1);
  }
}

// Adiciona os eventos de clique nos botões
prevBtn.addEventListener('click', function() {
  showPrev();
});

nextBtn.addEventListener('click', function() {
  showNext();
});

// Mostra o primeiro item ao carregar a página
showItem(0);