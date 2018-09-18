import React from 'react';
import {createStackNavigator} from 'react-navigation';
import Home from './src/pages/Home'
import Profile from './src/pages/Profile'

const RootStack = createStackNavigator({
    Home: Home,
    Profile: Profile,
});

export default class App extends React.Component {
    render() {
        return <RootStack/>;
    }
}
