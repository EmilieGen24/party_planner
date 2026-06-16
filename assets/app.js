// import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// FONCTION MENU BURGER
    document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.icon-burger');
    if (burger) {
        burger.addEventListener('click', () => {
            const link = document.querySelector('.links');
            if (link.style.display === 'block') {
                link.style.display = 'none';
            } else {
                link.style.display = 'block';
            }
        });
    }
});

// FONCTION COULEURS
document.addEventListener('DOMContentLoaded', () => {
  // récupère toutes les checkboxs de couleurs
  const checkboxes = document.querySelectorAll('.add-color input[type="checkbox"]'); 

  // création de la barre de visualisation
  const bar = document.createElement('div');
  bar.className = 'selected-colors-bar';
  bar.innerHTML = '<span style="font-size:13px;color:#888;align-self:center;">Aucune couleur sélectionnée</span>';

  // récupère le bloc de couleurs
  const wrapper = document.querySelector('.add-color');
  if (!wrapper) return;
  wrapper.parentNode.insertBefore(bar, wrapper.nextSibling);

  checkboxes.forEach(checkbox => {
    // récupère la couleur de la checkbox
    const hex = checkbox.getAttribute('data-hex');
    // récupère le label de la couleur
    const label = document.querySelector(`label[for="${checkbox.id}"]`);
    if (label && hex) {
      label.style.backgroundColor = hex;
      // si blanc ajoute un contour gris pour le rendre visible
      if (hex === '#FFFFFF') label.style.outline = '1px solid #ccc';
    }
    // met à jour la barre à chaque changement
    checkbox.addEventListener('change', renderBar);
  });

  // fonction de mise à jour de la barre de visualisation
  function renderBar() {
    bar.innerHTML = '';
    const checked = [...checkboxes].filter(c => c.checked);
    if (checked.length === 0) {
      bar.innerHTML = '<span style="font-size:13px;color:#888;align-self:center;">Aucune couleur sélectionnée</span>';
      return;
    }
    checked.forEach(checkbox => {
      const hex = checkbox.getAttribute('data-hex');
      const label = document.querySelector(`label[for="${checkbox.id}"]`);
      const name = label ? label.textContent.trim() : '';
      // crée une puce pour chaque couleur
      const chip = document.createElement('div');
      chip.className = 'selected-chip';
      // puce de couleur et nom de la puce
      chip.innerHTML = `<span class="dot" style="background:${hex};${hex==='#FFFFFF'?'outline:1px solid #ccc':''}"></span>${name}`;
      // ajoute la puce dans la barre
      bar.appendChild(chip);
    });
  }
});