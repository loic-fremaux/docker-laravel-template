import {defineConfig} from 'vite'
import reactRefresh from '@vitejs/plugin-react-refresh'
import {resolve} from 'path'

//on crée notre plugion pour refresh blade
const bladeRefreshPlugin = {
    name: 'twig-refresh',
    configureServer ({watcher, ws}){
        watcher.add(resolve('resources/views/*.blade.*'))
        watcher.on('change', function (path){
            if (path.endsWith('.blade.php')){
                ws.send({
                    type: 'full-reload'
                })
            }
        })
    }
}

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [reactRefresh(), bladeRefreshPlugin],
    root: './resources',
    base: '/assets/',
    server: {
        watch: {
            disableGlobbing: false,
        }
    },
    build: {
        outDir: '../public/assets',
        //1 seul fichier assets
        assetsDir: '',
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: undefined
            },
            input: {
                'main.jsx': './resources/js/main.jsx',
            }
        }
    }
})
