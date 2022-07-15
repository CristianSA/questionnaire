import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

export default new Vuetify({
    icons: {
        iconFont: 'mdi',
    },
    theme: {
        themes: {
            dark: {
                primary: '#3f51b5',
                secondary: '#696969',
                warning: '#f4d03f',
                accent: '#8c9eff',
                error: '#e74c3c',
                success: '#13C865',
            },
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                warning: '#f4d03f',
                accent: '#8c9eff',
                error: '#e74c3c',
                success: '#13C865',
            }
        },
    },
})