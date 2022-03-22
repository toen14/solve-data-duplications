const {loadTest} = require('loadtest');
const { faker } = require('@faker-js/faker');

loadTest({
    url: 'http://localhost/solve-data-duplications/index.php/transaksi',
    concurrency: 1000, // melakukan 1000 request diwaktu yg bersamaan
    maxRequests: 1000,
    method: "POST",
    body: {
        date: faker.time.recent('abbr'),
        name: faker.name.findName(),
        address: faker.address.cityName(),
        donation_type: faker.random.arrayElement(['kas', 'non kas'])
    },
}, function(error, result) {
    if (error) {
        console.log('Terjadi error', error);
    }

    console.log(result);
});