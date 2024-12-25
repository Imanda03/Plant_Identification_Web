import {View, Text} from 'react-native';
import React from 'react';
import {createNativeStackNavigator} from '@react-navigation/native-stack';
import LandingScreen from '../src/screen/auth/LandingScreen';
import AuthRoute from './StackRoute/AuthRoute';
import Tabs from './Tabs';

const RootStack = () => {
  const Stack = createNativeStackNavigator();

  const isLoggedIn = false;
  return (
    <Stack.Navigator>
      {isLoggedIn ? (
        <Stack.Screen
          name="Tabs"
          component={Tabs}
          options={{headerShown: false}}
        />
      ) : (
        <Stack.Screen
          name="Auths"
          component={AuthRoute}
          options={{headerShown: false}}
        />
      )}
    </Stack.Navigator>
  );
};

export default RootStack;
