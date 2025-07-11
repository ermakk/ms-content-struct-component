import {defineConfig} from 'vite';
export default defineConfig({
    build: {
        emptyOutDir: false,
        manifest: true,
        rollupOptions: {
            input: ['resources/css/main.css'],
            output: {
                assetFileNames: file => {
                    let ext = file.name.split('.').pop()
                    if (ext === 'css') {
                        return 'css/cs-component.css'
                    }
                }
            }
        },
        outDir: 'public',
    },
});
