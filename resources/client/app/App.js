import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import { Button } from 'antd-mobile-rn';

export default class App extends React.Component {
  render() {
    return (
      <View style={styles.container}>
        <Text>dscmall app!</Text>
        <Button>antd-mobile-rn button</Button>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
