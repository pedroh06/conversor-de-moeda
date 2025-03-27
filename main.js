function converter() {
    const real = parseFloat(document.getElementById('real').value);

    if (isNaN(real) || real <= 0) {
        document.getElementById('dolar').textContent = 'Insira um valor válido em reais!';
        return;
    }

    const cotacao = 5.17; // cotação fixa, futuramente trocar por uma api
    const dolar = real / cotacao;

    document.getElementById('dolar').textContent = `Valor em dólares: $${dolar.toFixed(2)}`;

}
