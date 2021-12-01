import Home from './pages/Home';
import CreateProduct from './pages/Product/Create';
import UpdateProduct from './pages/Product/Edit';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'createProduct',
        path: '/create-product',
        component: CreateProduct
    },
    {
        name: 'updateProduct',
        path: '/edit-product/:id',
        component: UpdateProduct
    }
];
