import '../sass/app.scss';

import 'document-register-element';
import 'classlist-polyfill';

import defineElement from './libs/define-element';

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

defineElement(KMenu, [KMenuItem]);
defineElement(KPlanner);
defineElement(KArea);
defineElement(KResizer);
defineElement(KInput);
defineElement(KCheckbox);
defineElement(KTextarea);
defineElement(KCartButton);
defineElement(KProductCard);
defineElement(KSelect, [KSelectOption]);
defineElement(KNotification);

(() => {
  const isTouchDevice = (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
  document.documentElement.classList.toggle('u-has-touch', isTouchDevice);
})();
