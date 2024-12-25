import {View, Text, Image, Button} from 'react-native';
import React from 'react';
import {createStyles} from './styles';
import {useTheme} from '../../../utils/colors';
import ButtonIconComponent from '../../../components/core/ButtonIcon';
import BackgroundWrapper from '../../../components/BackgroundWrapper';

const LandingScreen = ({navigation}: any) => {
  const {setTheme} = useTheme();
  const styles = createStyles();

  const navigateScreen = (screenName: string) => {
    navigation.navigate(screenName);
  };

  return (
    <BackgroundWrapper>
      {/* <Button
        onPress={() => setTheme(prev => (prev === 'light' ? 'dark' : 'light'))}
        title="Switch Mode"
      /> */}
      {/* <Text
        style={[
          styles.text,
          {fontWeight: '500', textAlign: 'center', top: 15},
        ]}>
        Welcome To Budget Tracker
      </Text> */}
      <Image
        source={require('../../../assets/Image/splashbg.png')}
        style={styles.image}
        resizeMode="contain"
      />
      <View style={styles.textContainer}>
        <Text style={[styles.text, {fontWeight: '500'}]}>Take Control </Text>
        <Text style={styles.text}>of Your</Text>
      </View>
      <Text style={[styles.text, {alignSelf: 'center'}]}>Finance Today</Text>
      <Text style={styles.textDescription}>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia fugit quo,
        alias atque expedita sunt quisquam consequatur, maiores voluptas ullam
        impedit inventore repellendus iste numquam.
      </Text>
      <View style={styles.ButtonContainer}>
        <ButtonIconComponent
          title="Login"
          onPress={() => navigateScreen('SignIn')}
          iconName="login"
        />
        <ButtonIconComponent
          title="Register"
          onPress={() => navigateScreen('SignUp')}
          iconName="arrow-with-circle-right"
        />
      </View>
    </BackgroundWrapper>
  );
};

export default LandingScreen;
