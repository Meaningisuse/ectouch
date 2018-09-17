
// ref: https://umijs.org/config/
export default {
  history: 'hash',
  outputPath: '../../public/static/mobile',
  publicPath: '/static/mobile/',
  plugins: [
    // ref: https://umijs.org/plugin/umi-plugin-react.html
    ['umi-plugin-react', {
      antd: true,
      dva: true,
      dynamicImport: true,
      title: 'client',
      dll: true,
      pwa: false,
      routes: {
        exclude: [],
      },
      hardSource: true,
    }],
  ],
}
