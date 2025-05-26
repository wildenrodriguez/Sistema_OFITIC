document.addEventListener('DOMContentLoaded', function() {
  const buscador = document.getElementById('buscador');
  const resultadoBusqueda = document.getElementById('resultado-busqueda');
  const mainContent = document.getElementById('main');
  let currentHighlightIndex = -1;
  let matches = [];

  // Función para limpiar resaltados anteriores
  function clearHighlights() {
    const highlights = mainContent.querySelectorAll('.search-highlight');
    highlights.forEach(highlight => {
      const parent = highlight.parentNode;
      parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
      parent.normalize(); // Une nodos de texto adyacentes
    });
  }

  // Función para resaltar coincidencias
  function highlightMatches(text) {
    clearHighlights();
    matches = [];
    
    if (!text.trim()) {
      resultadoBusqueda.textContent = '';
      return;
    }

    const walker = document.createTreeWalker(
      mainContent,
      NodeFilter.SHOW_TEXT,
      {
        acceptNode: function(node) {
          return node.textContent.trim() ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
        }
      }
    );

    const regex = new RegExp(text, 'gi');
    let node;
    let matchCount = 0;

    while (node = walker.nextNode()) {
      const content = node.textContent;
      const matchesInNode = [...content.matchAll(regex)];
      
      if (matchesInNode.length > 0) {
        const span = document.createElement('span');
        let lastIndex = 0;
        let newContent = '';

        matchesInNode.forEach(match => {
          newContent += content.substring(lastIndex, match.index);
          newContent += `<mark class="search-highlight">${match[0]}</mark>`;
          lastIndex = match.index + match[0].length;
          matchCount++;
          
          // Guardar posición del match
          matches.push({
            element: span,
            text: match[0]
          });
        });

        newContent += content.substring(lastIndex);
        span.innerHTML = newContent;
        node.replaceWith(span);
      }
    }

    // Actualizar contador de resultados
    if (matchCount > 0) {
      resultadoBusqueda.innerHTML = `Se encontraron ${matchCount} coincidencias`;
      currentHighlightIndex = 0;
      scrollToHighlight();
    } else {
      resultadoBusqueda.textContent = 'No se encontraron coincidencias';
    }
  }

  // Función para desplazarse al resaltado actual
  function scrollToHighlight() {
    if (matches.length > 0 && currentHighlightIndex >= 0) {
      const currentMatch = matches[currentHighlightIndex];
      currentMatch.element.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });
      
      // Resaltar adicionalmente el match actual
      const allHighlights = mainContent.querySelectorAll('.search-highlight');
      allHighlights.forEach((hl, index) => {
        hl.classList.toggle('current-highlight', index === currentHighlightIndex);
      });
    }
  }

  // Evento de búsqueda con debounce para mejor rendimiento
  let searchTimeout;
  buscador.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      highlightMatches(this.value);
    }, 300);
  });

  // Navegación entre resultados
  document.addEventListener('keydown', function(e) {
    if (matches.length === 0) return;
    
    if (e.key === 'Enter' || e.key === 'ArrowDown') {
      e.preventDefault();
      currentHighlightIndex = (currentHighlightIndex + 1) % matches.length;
      scrollToHighlight();
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      currentHighlightIndex = (currentHighlightIndex - 1 + matches.length) % matches.length;
      scrollToHighlight();
    }
  });
});