import app from './appComponents'
import renderVueComponentToString from 'vue-server-renderer/basic';


renderVueComponentToString(app, (err, html) => {
    if (err) {
        throw new Error(err);
    }

    dispatch(html);
});
