function clearInputs() {
    // Get all input elements on the page
    const inputElements = document.getElementsByTagName('input');

    // Loop through all input elements
    for (let i = 0; i < inputElements.length; i++) {
        // Check if the input element is not the "cancel" or "submit" input
        if (inputElements[i].id !== 'cancel' && inputElements[i].id !== 'addUser') {
            // Clear the input value
            inputElements[i].value = '';
        }
    }
}

