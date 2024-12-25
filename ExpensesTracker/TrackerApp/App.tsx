import {NavigationContainer} from '@react-navigation/native';
import {SafeAreaProvider} from 'react-native-safe-area-context';
import ThemeProvider from './src/context/ThemeProvider';
import RootStack from './RouteNavigation';

export default function App() {
  return (
    <SafeAreaProvider>
      <NavigationContainer>
        <ThemeProvider>
          <RootStack />
        </ThemeProvider>
      </NavigationContainer>
    </SafeAreaProvider>
  );
}
