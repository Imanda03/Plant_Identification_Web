import React, {useEffect, useRef} from 'react';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import {View, Text, StyleSheet, TouchableOpacity, Animated} from 'react-native';
import {IoniconsIcon} from '../../src/utils/Icon';
import HomeScreen from '../../src/screen/app/HomeScreen';
import ProfileScreen from '../../src/screen/app/ProfileScreen';
import HistoryScreen from '../../src/screen/app/HistoryScreen';
import {createStyles} from './styles';
import {useTheme} from '../../src/utils/colors';

const Tab = createBottomTabNavigator();

const Tabs = () => {
  const styles = createStyles();
  const {theme} = useTheme();
  return (
    <Tab.Navigator
      screenOptions={({route}) => ({
        tabBarHideOnKeyboard: true,
        tabBarIcon: ({focused, color, size}) => {
          let iconName;
          if (route.name === 'Home') {
            iconName = focused ? 'home' : 'home-outline';
          } else if (route.name === 'Profile') {
            iconName = focused ? 'person' : 'person-outline';
          } else if (route.name === 'History') {
            iconName = focused ? 'receipt-sharp' : 'receipt-outline';
          } else {
            iconName = focused ? 'person' : 'person-outline';
          }
          const iconColor = focused
            ? theme.NAVBAR_ACTIVE_TEXT
            : theme.NAVBAR_INACTIVE_TEXT;
          return <IoniconsIcon name={iconName} size={size} color={iconColor} />;
        },
        headerShown: false,
        tabBarLabel: ({focused}) => {
          return (
            <Text
              style={[
                styles.tabLabel,
                {
                  color: focused
                    ? theme.NAVBAR_ACTIVE_TEXT
                    : theme.NAVBAR_INACTIVE_TEXT,
                },
              ]}>
              {route.name}
            </Text>
          );
        },
        tabBarStyle: styles.tabBar,
        tabBarItemStyle: styles.tabBarItem,
        // tabBarIconStyle: styles.tabBarIcon,
      })}>
      <Tab.Screen
        name="Home"
        component={HomeScreen}
        options={{
          tabBarButton: props => <TabBarButton {...props} />,
        }}
      />

      <Tab.Screen
        name="History"
        component={HistoryScreen}
        options={{
          tabBarButton: props => <TabBarButton {...props} />,
        }}
      />

      <Tab.Screen
        name="Profile"
        component={ProfileScreen}
        options={{
          tabBarButton: props => <TabBarButton {...props} />,
        }}
      />
    </Tab.Navigator>
  );
};

const TabBarButton = ({accessibilityState, children, onPress}: any) => {
  const focused = accessibilityState.selected;

  // Animated values for the translation and scale
  const translateYValue = useRef(new Animated.Value(0)).current;

  useEffect(() => {
    Animated.spring(translateYValue, {
      toValue: focused ? -1 : 0,
      useNativeDriver: true,
    }).start();
  }, [focused]);

  const styles = createStyles();

  return (
    <TouchableOpacity
      onPress={onPress}
      activeOpacity={0.8}
      style={styles.tabBarButtonContainer}>
      <Animated.View
        style={[
          styles.tabBarButton,
          {
            transform: [{translateY: translateYValue}],
          },
          focused ? styles.tabBarButtonActive : null,
        ]}>
        {children}
      </Animated.View>
    </TouchableOpacity>
  );
};

export default Tabs;
