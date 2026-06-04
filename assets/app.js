// import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// fonction menu burger
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

// fonction couleurs
document.addEventListener('DOMContentLoaded', () => {
  const checkboxes = document.querySelectorAll('.add-color input[type="checkbox"]');
  const bar = document.createElement('div');
  bar.className = 'selected-colors-bar';
  bar.innerHTML = '<span style="font-size:13px;color:#888;align-self:center;">Aucune couleur sélectionnée</span>';

  const wrapper = document.querySelector('.add-color');
  if (!wrapper) return;
  wrapper.parentNode.insertBefore(bar, wrapper.nextSibling);

  checkboxes.forEach(checkbox => {
    const hex = checkbox.getAttribute('data-hex');
    const label = document.querySelector(`label[for="${checkbox.id}"]`);
    if (label && hex) {
      label.style.backgroundColor = hex;
      if (hex === '#FFFFFF') label.style.outline = '1px solid #ccc';
    }
    checkbox.addEventListener('change', renderBar);
  });

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
      const chip = document.createElement('div');
      chip.className = 'selected-chip';
      chip.innerHTML = `<span class="dot" style="background:${hex};${hex==='#FFFFFF'?'outline:1px solid #ccc':''}"></span>${name}`;
      bar.appendChild(chip);
    });
  }
});