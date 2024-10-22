export function formatCurrency(value) {
    if (value === null || value === undefined || isNaN(value)) return 'Rp. 0';
    
    const number = parseFloat(value);
    return number.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
}
