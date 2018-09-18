import React from "react";
import {FlatList, Image, StyleSheet, Text, View} from "react-native";
import { SearchBar, Carousel } from 'antd-mobile-rn';

let REQUEST_URL = "https://raw.githubusercontent.com/facebook/react-native/0.51-stable/docs/MoviesExample.json";

export default class Home extends React.Component {
    _keyExtractor = (item, index) => item.id;

    static navigationOptions = {
        title: 'Welcome App',
    };

    constructor(props) {
        super(props); // 这一句不能省略，照抄即可
        this.state = {
            value: '',
            data: [],
            loaded: false,
        };
        // 在ES6中，如果在自定义的函数里使用了this关键字，则需要对其进行“绑定”操作，否则this的指向不对
        // 像下面这行代码一样，在constructor中使用bind是其中一种做法（还有一些其他做法，如使用箭头函数等）
        this.fetchData = this.fetchData.bind(this);
    }

    componentDidMount() {
        this.fetchData();
    }

    fetchData() {
        fetch(REQUEST_URL)
            .then((response) => response.json())
            .then((responseData) => {
                // 注意，这里使用了this关键字，为了保证this在调用时仍然指向当前组件，我们需要对其进行“绑定”操作
                this.setState({
                    data: this.state.data.concat(responseData.movies),
                    loaded: true,
                });
            });
    }

    onChange = (value) => {
        this.setState({ value });
    }

    clear = () => {
        this.setState({ value: '' });
    }

    render() {
        if (!this.state.loaded) {
            return this.renderLoadingView();
        }

        return (
            <View>
                <SearchBar
                    value={this.state.value}
                    placeholder="搜索"
                    onCancel={this.clear}
                    onChange={this.onChange}
                />
                <Carousel
                    style={styles.wrapper}
                    selectedIndex={2}
                    autoplay
                    infinite
                    afterChange={this.onHorizontalSelectedIndexChange}
                >
                    <View style={[styles.containerHorizontal, { backgroundColor: 'red' }]}>
                        <Text>Carousel 1</Text>
                    </View>
                    <View style={[styles.containerHorizontal, { backgroundColor: 'blue' }]}>
                        <Text>Carousel 2</Text>
                    </View>
                    <View style={[styles.containerHorizontal, { backgroundColor: 'yellow' }]}>
                        <Text>Carousel 3</Text>
                    </View>
                    <View style={[styles.containerHorizontal, { backgroundColor: 'aqua' }]}>
                        <Text>Carousel 4</Text>
                    </View>
                    <View style={[styles.containerHorizontal, { backgroundColor: 'fuchsia' }]}>
                        <Text>Carousel 5</Text>
                    </View>
                </Carousel>
                <FlatList
                    data={this.state.data}
                    renderItem={this.renderMovie}
                    keyExtractor={this._keyExtractor}
                    style={styles.list}
                />
            </View>
        );
    }

    renderLoadingView() {
        return (
            <View style={styles.container}>
                <Text>
                    Loading...
                </Text>
            </View>
        );
    }

    renderMovie({item}) {
        return (
            <View style={styles.container}>
                <Image
                    source={{uri: item.posters.thumbnail}}
                    style={styles.thumbnail}
                    onPress={() => this.props.navigation.navigate('Profile')}
                />
                <View style={styles.rightContainer}>
                    <Text style={styles.title}>{item.title}</Text>
                    <Text style={styles.year}>{item.year}</Text>
                </View>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#F5FCFF',
        padding: 5,
    },
    rightContainer: {
        flex: 1,
    },
    list: {
        paddingTop: 20,
        backgroundColor: '#F5FCFF',
    },
    title: {
        fontSize: 20,
        marginBottom: 8,
        textAlign: 'center',
    },
    year: {
        textAlign: 'center',
    },
    thumbnail: {
        width: 120,
        height: 160
    },

    wrapper: {
        backgroundColor: '#fff',
    },
    containerHorizontal: {
        flexGrow: 1,
        alignItems: 'center',
        justifyContent: 'center',
        height: 160,
    },
    containerVertical: {
        flexGrow: 1,
        alignItems: 'center',
        justifyContent: 'center',
        height: 150,
    },
    text: {
        color: '#fff',
        fontSize: 36,
    },
});
