const optionTemplate = function(html, option) {
  const optionClassName = `c-select__option ${option.state.value === this._state.get('value') ? 'c-select__option--selected' : ''}`;

  return html`
    <div
      class="${optionClassName}"
      data-handler="option"
      onclick="${this}"
      data-content="${option.state.content}"
      data-value="${option.state.value}">${option.state.content}
    </div>
  `;
};

export default function(html) {
  return html`
    <div class="c-select__popup">
      ${this._state.get('options').map(option => optionTemplate.call(this, html, option))}
    </div>
  `;
};
