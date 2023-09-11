function formatAmount(input) {
    // Obtener el valor actual del campo de entrada
    let value = input.value;

    // Remover cualquier separador de miles existente (coma o punto)
    value = value.replace(/[,\.]/g, '');

    // Formatear el valor con separadores de miles
    value = Number(value).toLocaleString('es-ES');

    // Actualizar el valor del campo de entrada con el formato aplicado
    input.value = value;
  }
