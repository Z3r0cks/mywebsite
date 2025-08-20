/**
 * Tiny interactive single-neuron demo
 * Updates z = w*x + b and y = activation(z) in realtime
 */
(function () {
	function activation(value, type) {
		switch (type) {
			case 'relu':
				return Math.max(0, value);
			case 'sigmoid':
				return 1 / (1 + Math.exp(-value));
			default:
				return value; // linear
		}
	}

	function clamp(value, min, max) {
		return Math.min(max, Math.max(min, value));
	}

	function update() {
		const x = parseFloat(inputX.value) || 0;
		const w = parseFloat(weight.value) || 0;
		const b = parseFloat(bias.value) || 0;
		const act = activationSelect.value;

		const z = w * x + b;
		const y = activation(z, act);

		zOut.textContent = z.toFixed(2);
		yOut.textContent = y.toFixed(2);

		const normalized = clamp((y + 5) / 10, 0, 1);
		barFill.style.width = `${(normalized * 100).toFixed(0)}%`;
	}

	document.addEventListener('DOMContentLoaded', function () {
		inputX = document.getElementById('nn-input-x');
		weight = document.getElementById('nn-weight');
		bias = document.getElementById('nn-bias');
		activationSelect = document.getElementById('nn-activation');
		weightVal = document.getElementById('nn-weight-val');
		biasVal = document.getElementById('nn-bias-val');
		zOut = document.getElementById('nn-z');
		yOut = document.getElementById('nn-y');
		barFill = document.getElementById('nn-bar-fill');

		function syncLabels() {
			weightVal.textContent = parseFloat(weight.value).toFixed(1);
			biasVal.textContent = parseFloat(bias.value).toFixed(1);
		}

		['input', 'change'].forEach((evt) => {
			weight.addEventListener(evt, () => { syncLabels(); update(); });
			bias.addEventListener(evt, () => { syncLabels(); update(); });
			inputX.addEventListener(evt, update);
			activationSelect.addEventListener(evt, update);
		});

		syncLabels();
		update();
	});
})();



