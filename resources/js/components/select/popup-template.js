const optionTemplate = function(html, option) {
  const optionClassName = `c-select__option ${option.state.value === this._state.get('value') ? 'c-select__option--selected' : ''}`;

  return html`<div class="${optionClassName}" data-handler="option" onclick="${this}" data-value="${option.state.value}">${option.state.content}</div>`;
};

export default function(html) {
  const width = `min-width: ${this.querySelector('.c-select__opener').offsetWidth}px`;

  return html`
    <div class="c-select__popup" style="${width}">
      ${this._state.get('options').map(option => optionTemplate.call(this, html, option))}
    </div>
  `;
};
