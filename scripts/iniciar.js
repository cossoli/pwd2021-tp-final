// @ts-check
const { resolve } = require('path');

const concurrently = require('concurrently');

concurrently(
  [
    {
      command: 'php configs/rutas.php',
      name: ' rutas',
      prefixColor: 'magenta',
    },
    {
      command:
        'php -dxdebug.mode=debug -dxdebug.start_with_request=yes -S localhost:8080 src/server.php',
      name: 'server',
      prefixColor: 'blue',
    },
    {
      command: 'vite --clearScreen=false',
      name: ' vite ',
      prefixColor: 'green',
    },
  ],
  {
    prefix: 'name',
    cwd: resolve(__dirname, '..'),
  },
).then(
  () => {
    process.exit(0);
  },
  (err) => {
    throw err;
  },
);
