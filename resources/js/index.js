import '../sass/app.scss';

import 'document-register-element';
import 'classlist-polyfill';

import KMenu from './components/menu';
import KMenuItem from './components/menu-item';
import KPlanner from './components/planner';
import KArea from './components/area';
import KResizer from './components/resizer';
import KInput from './components/input';
import KCheckbox from './components/checkbox';
import KTextarea from './components/textarea';
import KCartButton from './components/cart-button';
import KProductCard from './components/product-card';
import KSelect from './components/select';
import KSelectOption from './components/select-option';
import KNotification from './components/notification';

customElements.define('k-menu', KMenu);
customElements.define('k-menu-item', KMenuItem);
customElements.define('k-planner', KPlanner);
customElements.define('k-area', KArea);
customElements.define('k-resizer', KResizer);
customElements.define('k-input', KInput);
customElements.define('k-checkbox', KCheckbox);
customElements.define('k-textarea', KTextarea);
customElements.define('k-cart-button', KCartButton);
customElements.define('k-product-card', KProductCard);
customElements.define('k-select', KSelect);
customElements.define('k-select-option', KSelectOption);
customElements.define('k-notification', KNotification);

(() => {
  const isTouchDevice = (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
  document.documentElement.classList.toggle('u-has-touch', isTouchDevice);
})();
