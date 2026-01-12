document.addEventListener('DOMContentLoaded', function () {

  const form = document.getElementById('projetForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Récupération des données
    const formData = new FormData(form);

    const nom = formData.get('nom')?.trim();
    const email = formData.get('email')?.trim();
    const type = formData.get('type_projet')?.trim();
    const description = formData.get('description')?.trim();

    // Validation minimale
    if (!nom || !email || !type || !description) {
      alert('Veuillez remplir les champs obligatoires');
      return;
    }

    // Envoi AJAX vers PHP
    fetch('demande-projet.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      const cleanData = data.trim();

      // Si PHP renvoie une URL WhatsApp → redirection
      if (cleanData.startsWith('https://wa.me/')) {
        window.location.href = cleanData;
      } else {
        console.error('Réponse inattendue :', cleanData);
        alert('Erreur lors de l’envoi. Veuillez réessayer.');
      }
    })
    .catch(error => {
      console.error(error);
      alert('Erreur réseau. Vérifiez votre connexion.');
    });

  });

});
