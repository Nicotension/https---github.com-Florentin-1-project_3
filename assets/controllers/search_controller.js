import { Controller } from 'stimulus';

export default class extends Controller {

    update(event) {
        const query = event.target.value;
        this.fetchResults(query);
    }

    fetchResults(query) {
        if (query.length > 0) {
            fetch(`/search?query=${query}`, {
                headers: {
                    'Accept': 'text/html',
                },
            })
            .then(response => response.text())
            .then(html => {
                
                document.body.innerHTML = html;
            });
        }
    }
}
